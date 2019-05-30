<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 28/05/19
 * Time: 21:27
 */

namespace App\Client;

use App\Exception\OrderCreateException;
use App\Model\OrderCreate;
use App\Model\OrderCreateResponse;
use JMS\Serializer\SerializerInterface;
use OldSound\RabbitMqBundle\RabbitMq\RpcClient;
use PhpAmqpLib\Exception\AMQPTimeoutException;

class OrderCreateClient
{
    private $rpcClient;
    private $serializer;
    private $server;
    private $responseModelClass;
    private $correlationId;

    public function __construct(RpcClient $rpcClient, SerializerInterface $serializer, $server, OrderCreateResponse $responseModelClass)
    {
        $this->rpcClient = $rpcClient;
        $this->serializer = $serializer;
        $this->server = $server;
        $this->responseModelClass = $responseModelClass;
        $this->correlationId = 'order_create_'.crc32(microtime());
    }

    public function call(OrderCreate $order)
    {
        $response = $this->doCall($order);

        return $this->serializer->deserialize($response, get_class($this->responseModelClass), 'json');
    }

    private function doCall(OrderCreate $order)
    {
        $this->rpcClient->addRequest(serialize($order), $this->server, $this->correlationId, null, 30);
        try {
            $reply = $this->rpcClient->getReplies();
        } catch (AMQPTimeoutException $e) {
            throw new OrderCreateException($e->getMessage());
        }

        if (!isset($reply[$this->correlationId])) {
            throw new OrderCreateException(
                sprintf('RPC call response does not contain correlation id [%].', $this->correlationId)
            );
        }

        return $reply[$this->correlationId];
    }
}
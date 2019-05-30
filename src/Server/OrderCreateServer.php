<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 28/05/19
 * Time: 21:28
 */

namespace App\Server;

use App\Model\OrderCreate;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

class OrderCreateServer implements ConsumerInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $message)
    {
        $this->logger->info(json_encode($message));
sleep(10);
        /** @var OrderCreate $body */
        $body = unserialize($message->body);
        echo $body->id.PHP_EOL;
        echo $body->customerName.PHP_EOL;
        echo $body->carMake.PHP_EOL;
        echo $body->carModel.PHP_EOL;

        return json_encode([
            'body' => json_encode($body),
            'errors' => [
                'Fake ID error',
                'Fake Car Model error'
            ]
        ]);
    }
}
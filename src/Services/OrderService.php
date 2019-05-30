<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 27/05/19
 * Time: 21:15
 */

namespace App\Services;


use App\Client\OrderCreateClient;
use App\Entity\Order;
use App\Model\OrderCreate;
use App\Model\OrderCreateResponse;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    private $entityManager;
    private $orderCreateClient;

    public function __construct(EntityManagerInterface $entityManager, OrderCreateClient $orderCreateClient)
    {
        $this->entityManager = $entityManager;
        $this->orderCreateClient = $orderCreateClient;
    }

    /**
     * @param array $newOrder
     *
     * @return OrderCreateResponse
     */
    public function create(array $newOrder)
    {
        $order = new Order();
        $order->setCustomerName($newOrder['customer_name']);
        $order->setCarMake($newOrder['car_make']);
        $order->setCarModel($newOrder['car_model']);

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        // This mapping could be done in controller while running request validation
        $orderCreate = new OrderCreate();
        $orderCreate->id = $order->getId();
        $orderCreate->customerName = $newOrder['customer_name'];
        $orderCreate->carMake = $newOrder['car_make'];
        $orderCreate->carModel = $newOrder['car_model'];

        return $this->orderCreateClient->call($orderCreate);
    }
}
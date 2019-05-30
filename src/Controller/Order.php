<?php

namespace App\Controller;

use App\Services\OrderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("order")
 */
class Order
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     *
     * @Route("/create", methods={"POST"})
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        // Request should actually have been validated and mapped to OrderCreate model then sent to Service
        $result = $this->orderService->create(json_decode($request->getContent(), true));

        return new Response(json_encode($result));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 28/05/19
 * Time: 21:24
 */

namespace App\Model;

class OrderCreate
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $customerName;

    /**
     * @var string
     */
    public $carMake;

    /**
     * @var string
     */
    public $carModel;
}
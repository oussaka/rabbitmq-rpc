<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 28/05/19
 * Time: 21:25
 */

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

class OrderCreateResponse
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    public $body;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     */
    public $errors = [];
}
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="smallint")
     */
    private $id;

    /**
     * @ORM\Column(name="customer_name", type="string", length=50)
     */
    private $customerName;

    /**
     * @ORM\Column(name="car_make",type="string", length=50)
     */
    private $carMake;

    /**
     * @ORM\Column(name="car_model", type="string", length=50)
     */
    private $carModel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $name): self
    {
        $this->customerName = $name;

        return $this;
    }

    public function getCarMake(): ?string
    {
        return $this->carMake;
    }

    public function setCarMake(string $car_make): self
    {
        $this->carMake = $car_make;

        return $this;
    }

    public function getCarModel(): ?string
    {
        return $this->carModel;
    }

    public function setCarModel(string $car_model): self
    {
        $this->carModel = $car_model;

        return $this;
    }
}

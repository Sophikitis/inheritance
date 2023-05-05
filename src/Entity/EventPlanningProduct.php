<?php

namespace App\Entity;

use App\Repository\EventPlanningProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventPlanningProductRepository::class)]
class EventPlanningProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'eventPlanningProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $product = null;

    #[ORM\ManyToOne(inversedBy: 'eventPlanningProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EventPlanning $eventPlanning = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getEventPlanning(): ?EventPlanning
    {
        return $this->eventPlanning;
    }

    public function setEventPlanning(?EventPlanning $eventPlanning): self
    {
        $this->eventPlanning = $eventPlanning;

        return $this;
    }
}

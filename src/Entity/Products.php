<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\ManyToMany(targetEntity: EventPlanning::class, mappedBy: 'product')]
    private Collection $eventPlannings;

    public function __construct()
    {
        $this->eventPlannings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, EventPlanning>
     */
    public function getEventPlannings(): Collection
    {
        return $this->eventPlannings;
    }

    public function addEventPlanning(EventPlanning $eventPlanning): self
    {
        if (!$this->eventPlannings->contains($eventPlanning)) {
            $this->eventPlannings->add($eventPlanning);
            $eventPlanning->addProduct($this);
        }

        return $this;
    }

    public function removeEventPlanning(EventPlanning $eventPlanning): self
    {
        if ($this->eventPlannings->removeElement($eventPlanning)) {
            $eventPlanning->removeProduct($this);
        }

        return $this;
    }
}

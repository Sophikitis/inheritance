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

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: EventPlanningProduct::class)]
    private Collection $eventPlanningProducts;


    public function __construct()
    {
        $this->eventPlanningProducts = new ArrayCollection();
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
     * @return Collection<int, EventPlanningProduct>
     */
    public function getEventPlanningProducts(): Collection
    {
        return $this->eventPlanningProducts;
    }

    public function addEventPlanningProduct(EventPlanningProduct $eventPlanningProduct): self
    {
        if (!$this->eventPlanningProducts->contains($eventPlanningProduct)) {
            $this->eventPlanningProducts->add($eventPlanningProduct);
            $eventPlanningProduct->setProduct($this);
        }

        return $this;
    }

    public function removeEventPlanningProduct(EventPlanningProduct $eventPlanningProduct): self
    {
        if ($this->eventPlanningProducts->removeElement($eventPlanningProduct)) {
            // set the owning side to null (unless already changed)
            if ($eventPlanningProduct->getProduct() === $this) {
                $eventPlanningProduct->setProduct(null);
            }
        }

        return $this;
    }

}

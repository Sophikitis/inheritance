<?php

namespace App\Entity;

use App\Repository\EvtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvtRepository::class)]
#[ORM\InheritanceType('JOINED')] // <-- this is the important part! JOINED = table per class (default), SINGLE_TABLE = table per hierarchy
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['evt_sport' => EventPlanningSport::class, 'evt_conference' => EventPlanningConference::class])]
class EventPlanning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'eventsPlanning')]
    private ?Event $event = null;

    #[ORM\OneToMany(mappedBy: 'eventPlanning', targetEntity: EventPlanningProduct::class)]
    private Collection $eventPlanningProducts;



    public function __construct()
    {
        $this->eventPlanningProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

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
            $eventPlanningProduct->setEventPlanning($this);
        }

        return $this;
    }

    public function removeEventPlanningProduct(EventPlanningProduct $eventPlanningProduct): self
    {
        if ($this->eventPlanningProducts->removeElement($eventPlanningProduct)) {
            // set the owning side to null (unless already changed)
            if ($eventPlanningProduct->getEventPlanning() === $this) {
                $eventPlanningProduct->setEventPlanning(null);
            }
        }

        return $this;
    }

}

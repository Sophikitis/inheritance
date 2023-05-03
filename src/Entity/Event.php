<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventPlanning::class)]
    private Collection $eventsPlanning;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    public function __construct()
    {
        $this->eventsPlanning = new ArrayCollection();
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

    /**
     * @return Collection<int, EventPlanning>
     */
    public function getEventsPlanning(): Collection
    {
        return $this->eventsPlanning;
    }

    public function addEventsPlanning(EventPlanning $eventsPlanning): self
    {
        if (!$this->eventsPlanning->contains($eventsPlanning)) {
            $this->eventsPlanning->add($eventsPlanning);
            $eventsPlanning->setEvent($this);
        }

        return $this;
    }

    public function removeEventsPlanning(EventPlanning $eventsPlanning): self
    {
        if ($this->eventsPlanning->removeElement($eventsPlanning)) {
            // set the owning side to null (unless already changed)
            if ($eventsPlanning->getEvent() === $this) {
                $eventsPlanning->setEvent(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}

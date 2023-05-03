<?php

namespace App\Entity;

use App\Repository\EvtConferenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvtConferenceRepository::class)]
class EventPlanningConference extends EventPlanning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $speaker = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpeaker(): ?string
    {
        return $this->speaker;
    }

    public function setSpeaker(string $speaker): self
    {
        $this->speaker = $speaker;

        return $this;
    }
}

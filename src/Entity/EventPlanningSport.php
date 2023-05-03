<?php

namespace App\Entity;

use App\Repository\EvtSportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvtSportRepository::class)]
class EventPlanningSport extends EventPlanning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $opponentTeamName = null;

    #[ORM\Column(length: 255)]
    private ?string $OpponentTeamLogo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpponentTeamName(): ?string
    {
        return $this->opponentTeamName;
    }

    public function setOpponentTeamName(string $opponentTeamName): self
    {
        $this->opponentTeamName = $opponentTeamName;

        return $this;
    }

    public function getOpponentTeamLogo(): ?string
    {
        return $this->OpponentTeamLogo;
    }

    public function setOpponentTeamLogo(string $OpponentTeamLogo): self
    {
        $this->OpponentTeamLogo = $OpponentTeamLogo;

        return $this;
    }
}

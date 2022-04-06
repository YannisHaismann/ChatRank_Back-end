<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChampionLolRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ChampionLolRepository::class)
 */
#[ApiResource]
class ChampionLol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("user:read")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $loose;

    /**
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $win;

    /**
     * @ORM\ManyToOne(targetEntity=LeagueOfLegend::class, inversedBy="championsLol")
     * @ORM\JoinColumn(nullable=false)
     */
    private $leagueOfLegend;

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

    public function getLoose(): ?int
    {
        return $this->loose;
    }

    public function setLoose(int $loose): self
    {
        $this->loose = $loose;

        return $this;
    }

    public function getWin(): ?int
    {
        return $this->win;
    }

    public function setWin(int $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getLeagueOfLegend(): ?LeagueOfLegend
    {
        return $this->leagueOfLegend;
    }

    public function setLeagueOfLegend(?LeagueOfLegend $leagueOfLegend): self
    {
        $this->leagueOfLegend = $leagueOfLegend;

        return $this;
    }
}

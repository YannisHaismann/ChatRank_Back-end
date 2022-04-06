<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LineLolRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LineLolRepository::class)
 */
#[ApiResource]
class LineLol
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
    private $playedRate;

    /**
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $winRate;

    /**
     * @ORM\ManyToOne(targetEntity=LeagueOfLegend::class, inversedBy="lineLols")
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

    public function getPlayedRate(): ?int
    {
        return $this->playedRate;
    }

    public function setPlayedRate(int $playedRate): self
    {
        $this->playedRate = $playedRate;

        return $this;
    }

    public function getWinRate(): ?int
    {
        return $this->winRate;
    }

    public function setWinRate(int $winRate): self
    {
        $this->winRate = $winRate;

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

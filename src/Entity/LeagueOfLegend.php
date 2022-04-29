<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LeagueOfLegendRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LeagueOfLegendRepository::class)
 */
#[ApiResource]
class LeagueOfLegend
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
    private $username;

    /**
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $actualSeason;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("user:read")
     */
    private $rankedSolo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("user:read")
     */
    private $rankedFlex;

    /**
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $win;

    /**
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $loose;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="leagueOfLegend", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=LineLol::class, mappedBy="leagueOfLegend", cascade={"persist", "remove"})
     * @Groups ("user:read")
     */
    private $linesLol;

    /**
     * @ORM\OneToMany(targetEntity=ChampionLol::class, mappedBy="leagueOfLegend", cascade={"persist", "remove"})
     * @Groups ("user:read")
     */
    private $championsLol;

    public function __construct()
    {
        $this->linesLol = new ArrayCollection();
        $this->championsLol = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getActualSeason(): ?int
    {
        return $this->actualSeason;
    }

    public function setActualSeason(int $actualSeason): self
    {
        $this->actualSeason = $actualSeason;

        return $this;
    }

    public function getRankedSolo(): ?string
    {
        return $this->rankedSolo;
    }

    public function setRankedSolo(string $rankedSolo): self
    {
        $this->rankedSolo = $rankedSolo;

        return $this;
    }

    public function getRankedFlex(): ?string
    {
        return $this->rankedFlex;
    }

    public function setRankedFlex(string $rankedFlex): self
    {
        $this->rankedFlex = $rankedFlex;

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

    public function getLoose(): ?int
    {
        return $this->loose;
    }

    public function setLoose(int $loose): self
    {
        $this->loose = $loose;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, LineLol>
     */
    public function getLinesLol(): Collection
    {
        return $this->linesLol;
    }

    public function addLinesLol(LineLol $linesLol): self
    {
        if (!$this->linesLol->contains($linesLol)) {
            $this->linesLol[] = $linesLol;
            $linesLol->setLeagueOfLegend($this);
        }

        return $this;
    }

    public function removeLineLol(LineLol $linesLol): self
    {
        if ($this->linesLol->removeElement($linesLol)) {
            // set the owning side to null (unless already changed)
            if ($linesLol->getLeagueOfLegend() === $this) {
                $linesLol->setLeagueOfLegend(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ChampionLol>
     */
    public function getChampionsLol(): Collection
    {
        return $this->championsLol;
    }

    public function addChampionsLol(ChampionLol $championsLol): self
    {
        if (!$this->championsLol->contains($championsLol)) {
            $this->championsLol[] = $championsLol;
            $championsLol->setLeagueOfLegend($this);
        }

        return $this;
    }

    public function removeChampionsLol(ChampionLol $championsLol): self
    {
        if ($this->championsLol->removeElement($championsLol)) {
            // set the owning side to null (unless already changed)
            if ($championsLol->getLeagueOfLegend() === $this) {
                $championsLol->setLeagueOfLegend(null);
            }
        }

        return $this;
    }
}

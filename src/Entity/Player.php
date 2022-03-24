<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nickname;

    /**
     * @ORM\OneToMany(targetEntity=Contest::class, mappedBy="winner")
     */
    private $winner_contests;

    public function __construct()
    {
        $this->winner_contests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @return Collection<int, Contest>
     */
    public function getWinnerContests(): Collection
    {
        return $this->winner_contests;
    }

    public function addWinnerContest(Contest $winnerContest): self
    {
        if (!$this->winner_contests->contains($winnerContest)) {
            $this->winner_contests[] = $winnerContest;
            $winnerContest->setWinner($this);
        }

        return $this;
    }

    public function removeWinnerContest(Contest $winnerContest): self
    {
        if ($this->winner_contests->removeElement($winnerContest)) {
            // set the owning side to null (unless already changed)
            if ($winnerContest->getWinner() === $this) {
                $winnerContest->setWinner(null);
            }
        }

        return $this;
    }
}

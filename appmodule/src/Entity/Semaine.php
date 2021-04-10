<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SemaineRepository;

/**
 * @ORM\Entity(repositoryClass=SemaineRepository::class)
 */
class Semaine
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var float|null
     * @ORM\Column(type="float")
     */
    private ?float $semaine = null;

    /**
     * @var float|null
     * @ORM\Column(type="float")
     */
    private ?float $CM = null;

    /**
     * @var float|null
     * @ORM\Column(type="float")
     */
    private ?float $TD = null;

    /**
     * @var float|null
     * @ORM\Column(type="float")
     */
    private ?float $TP = null;

    /**
     * @var float|null
     * @ORM\Column(type="float")
     */
    private ?float $surveillances = null;

    /**
     * @var float|null
     * @ORM\Column(type="float")
     */
    private ?float $charges = null;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $commentaires = null;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="semaines")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Module $module = null;

    /**
     * @ORM\ManyToMany(targetEntity=ModuleDetails::class, mappedBy="semaine")
     */
    private Collection $moduleDetails;

    public function __construct()
    {
        $this->moduleDetails = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return float|null
     */
    public function getSemaine(): ?float
    {
        return $this->semaine;
    }

    /**
     * @param float|null $semaine
     */
    public function setSemaine(?float $semaine): void
    {
        $this->semaine = $semaine;
    }

    /**
     * @return float|null
     */
    public function getCM(): ?float
    {
        return $this->CM;
    }

    /**
     * @param float|null $CM
     */
    public function setCM(?float $CM): void
    {
        $this->CM = $CM;
    }

    /**
     * @return float|null
     */
    public function getTD(): ?float
    {
        return $this->TD;
    }

    /**
     * @param float|null $TD
     */
    public function setTD(?float $TD): void
    {
        $this->TD = $TD;
    }

    /**
     * @return float|null
     */
    public function getTP(): ?float
    {
        return $this->TP;
    }

    /**
     * @param float|null $TP
     */
    public function setTP(?float $TP): void
    {
        $this->TP = $TP;
    }

    /**
     * @return float|null
     */
    public function getSurveillances(): ?float
    {
        return $this->surveillances;
    }

    /**
     * @param float|null $surveillances
     */
    public function setSurveillances(?float $surveillances): void
    {
        $this->surveillances = $surveillances;
    }

    /**
     * @return float|null
     */
    public function getCharges(): ?float
    {
        return $this->charges;
    }

    /**
     * @param float|null $charges
     */
    public function setCharges(?float $charges): void
    {
        $this->charges = $charges;
    }

    /**
     * @return string|null
     */
    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    /**
     * @param string|null $commentaires
     */
    public function setCommentaires(?string $commentaires): void
    {
        $this->commentaires = $commentaires;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return Collection|ModuleDetails[]
     */
    public function getModuleDetails(): Collection
    {
        return $this->moduleDetails;
    }

    public function addModuleDetail(ModuleDetails $moduleDetail): self
    {
        if (!$this->moduleDetails->contains($moduleDetail)) {
            $this->moduleDetails[] = $moduleDetail;
            $moduleDetail->setSemaine($this);
        }

        return $this;
    }

    public function removeModuleDetail(ModuleDetails $moduleDetail): self
    {
        if ($this->moduleDetails->removeElement($moduleDetail)) {
            $moduleDetail->setSemaine(null);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ModuleDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModuleDetailsRepository::class)
 */
class ModuleDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $nbGroupes;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private ?string $typeCours;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="details")
     */
    private ?Module $module;

    /**
     * @ORM\ManyToOne(targetEntity=Enseignant::class, inversedBy="interventions")
     */
    private ?Enseignant $enseignant;

    /**
     * @ORM\ManyToOne(targetEntity=Semaine::class)
     */
    private ?Semaine $semaine;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getNbGroupes(): ?int
    {
        return $this->nbGroupes;
    }

    /**
     * @param int $nbGroupes
     * @return $this
     */
    public function setNbGroupes(int $nbGroupes): self
    {
        $this->nbGroupes = $nbGroupes;

        return $this;
    }

    public function getTypeCours(): ?string
    {
        return $this->typeCours;
    }

    public function setTypeCours(string $typeCours): self
    {
        $this->typeCours = $typeCours;

        return $this;
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

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getSemaine(): ?Semaine
    {
        return $this->semaine;
    }

    public function setSemaine(?Semaine $semaine): self
    {
        $this->semaine = $semaine;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Entity\Enseignant;

/**
 * @ORM\Entity(repositoryClass=ModuleRepository::class)
 * @ORM\Table(name="module")
 * @UniqueEntity(
 *     fields={"PPN"},
 *     errorPath="PPN",
 *     message="Ce module existe déjà."
 * )
 */
class Module
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=8)
     * @Groups({"module:read", "responsables:list"})
     * @Assert\Regex("/^M\d{4}([A-Z]{3}){0,1}$/")
     * @Assert\NotBlank()
     */
    private ?string $PPN = null;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @Groups({"module:read"})
     * @Assert\NotBlank();
     */
    private ?string $intitule = null;

    /**
     * @ORM\ManyToMany(targetEntity=Enseignant::class, inversedBy="modules")
     * @Groups ({"responsables:list"})
     */
    private Collection $responsables;

    /**
     * @ORM\OneToMany(targetEntity=Semaine::class, mappedBy="module")
     */
    private Collection $semaines;

    /**
     * @ORM\OneToMany(targetEntity=ModuleDetails::class, mappedBy="module")
     */
    private Collection $details;

    /**
     * Module constructor.
     */
    public function __construct()
    {
        $this->responsables = new ArrayCollection();
        $this->semaines = new ArrayCollection();
        $this->details = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getPPN(): ?string
    {
        return $this->PPN;
    }

    /**
     * @param string|null $PPN
     */
    public function setPPN(?string $PPN): void
    {
        $this->PPN = $PPN;
    }

    /**
     * @return string|null
     */
    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    /**
     * @param string|null $intitule
     */
    public function setIntitule(?string $intitule): void
    {
        $this->intitule = $intitule;
    }

    /**
     * @return Collection|Enseignant[]
     */
    public function getResponsables(): Collection
    {
        return $this->responsables;
    }

    /**
     * @param \App\Entity\Enseignant $responsable
     * @return $this
     */
    public function addResponsable(Enseignant $responsable): self
    {
        if (!$this->responsables->contains($responsable)) {
            $this->responsables[] = $responsable;
        }
        return $this;
    }

    /**
     * @param \App\Entity\Enseignant $responsable
     * @return $this
     */
    public function removeResponsable(Enseignant $responsable): self
    {
        $this->responsables->removeElement($responsable);
        return $this;
    }

    /**
     * @return Collection|Semaine[]
     */
    public function getSemaines(): Collection
    {
        return $this->semaines;
    }

    /**
     * @param Semaine $semaine
     * @return $this
     */
    public function addSemaine(Semaine $semaine): self
    {
        if (!$this->semaines->contains($semaine)) {
            $this->semaines[] = $semaine;
            $semaine->setModule($this);
        }
        return $this;
    }

    /**
     * @param Semaine $semaine
     * @return $this
     */
    public function removeSemaine(Semaine $semaine): self
    {
        if ($this->semaines->removeElement($semaine)) {
            // set the owning side to null (unless already changed)
            if ($semaine->getModule() === $this) {
                $semaine->setModule(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|ModuleDetails[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(ModuleDetails $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setModule($this);
        }
        return $this;
    }

    /**
     * @param ModuleDetails $detail
     * @return $this
     */
    public function removeDetail(ModuleDetails $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getModule() === $this) {
                $detail->setModule(null);
            }
        }
        return $this;
    }
}

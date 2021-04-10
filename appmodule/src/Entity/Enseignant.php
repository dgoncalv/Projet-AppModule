<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\EnseignantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 * @ORM\Table(name="enseignant")
 * @UniqueEntity(
 *     fields={"trigramme", "nom", "prenom"},
 *     errorPath="trigramme",
 *     message="Ce professeur existe déjà."
 * )
 * @UniqueEntity(
 *     fields={"trigramme"},
 *     errorPath="trigramme",
 *     message="Il existe déjà un professeur portant ce trigramme."
 * )
 * @UniqueEntity(
 *     fields={"prenom", "nom"},
 *     errorPath="nom",
 *     message="Ce professeur existe déjà sous un autre trigramme."
 * )
 * @UniqueEntity(
 *     fields={"prenom", "nom"},
 *     errorPath="prenom",
 *     message="Ce professeur existe déjà sous un autre trigramme."
 * )
 */
class Enseignant
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
     * @ORM\Column(type="string", length=4)
     * @Groups({"enseignant:read", "enseignant:write", "responsables:list"})
     * @Assert\Length(
     *     min=2,
     *     max=4,
     *     minMessage="Le trigramme doit avoir une longueur entre 2 et 4.",
     *     minMessage="Le trigramme doit avoir une longueur entre 2 et 4."
     * )
     */
    private ?string $trigramme = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=30)
     * @Groups({"enseignant:read", "enseignant:write"})
     * @Assert\NotBlank(message="Un enseignant doit evoir un prénom.");
     */
    private ?string $prenom = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=50)
     * @Groups({"enseignant:read", "enseignant:write"})
     * @Assert\NotBlank(message="Un enseignant doit evoir un nom.")
     */
    private ?string $nom = null;

    /**
     * @var float|null
     * @ORM\Column(type="float")
     * @Groups({"enseignant:read", "enseignant:write"})
     * @Assert\PositiveOrZero(message="Le service dû doit être un nombre positif.")
     */
    private ?float $serviceDu = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=8)
     * @Groups({"enseignant:read", "enseignant:write"})
     */
    private ?string $statut = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=12, nullable=true)
     * @Groups({"enseignant:read", "enseignant:write"})
     */
    private ?string $contact = null;

    /**
     * @ORM\ManyToMany(targetEntity=Module::class, mappedBy="responsables")
     */
    private Collection $modules;

    /**
     * @ORM\OneToMany(targetEntity=ModuleDetails::class, mappedBy="enseignant")
     */
    private Collection $interventions;

    /**
     * Enseignant constructor.
     */
    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->interventions = new ArrayCollection();
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
    public function getTrigramme(): ?string
    {
        return $this->trigramme;
    }

    /**
     * @param string|null $trigramme
     */
    public function setTrigramme(?string $trigramme): void
    {
        $this->trigramme = $trigramme;
    }

    /**
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom
     */
    public function setPrenom(?string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     */
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return float|null
     */
    public function getServiceDu(): ?float
    {
        return $this->serviceDu;
    }

    /**
     * @param float|null $serviceDu
     */
    public function setServiceDu(?float $serviceDu): void
    {
        $this->serviceDu = $serviceDu;
    }

    /**
     * @return string|null
     */
    public function getStatut(): ?string
    {
        return $this->statut;
    }

    /**
     * @param string|null $statut
     */
    public function setStatut(?string $statut): void
    {
        $this->statut = $statut;
    }

    /**
     * @return string|null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string|null $contact
     */
    public function setContact(?string $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->addResponsable($this);
        }

        return $this;
    }

    /**
     * @return Collection|ModuleDetails[]
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(ModuleDetails $intervention): self
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions[] = $intervention;
            $intervention->setEnseignant($this);
        }

        return $this;
    }

    public function removeIntervention(ModuleDetails $intervention): self
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getEnseignant() === $this) {
                $intervention->setEnseignant(null);
            }
        }

        return $this;
    }
}

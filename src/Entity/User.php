<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     */
    public $nom;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     */
    public $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     * @ORM\JoinColumn(nullable=true)
     */
    public $cin;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     */
    public $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     * @ORM\JoinColumn(nullable=true)
     */
    public $ville;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     * @ORM\JoinColumn(nullable=true)
     */
    public $genre;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     */
    public $email;

    

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     * @ORM\JoinColumn(nullable=true)
     */
    public $couvSociale;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     * @ORM\JoinColumn(nullable=true)
     */
    public $profession;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     */
    public $password;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     * @ORM\JoinColumn(nullable=true)
     */
    public $age;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     * @ORM\JoinColumn(nullable=true)
     */
    public $image;

    /**
     * @ORM\OneToMany(targetEntity=Fichier::class, mappedBy="user")
     *  @Groups("post:read")
     * @ORM\JoinColumn(nullable=true)
     */
    public $fichiers;

    public function __construct()
    {
        $this->fichiers = new ArrayCollection();
        $this->fich = new ArrayCollection();
        $this->fichiersf = new ArrayCollection();
    }

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

  
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

   

    public function getCouvSociale(): ?string
    {
        return $this->couvSociale;
    }

    public function setCouvSociale(?string $couvSociale): self
    {
        $this->couvSociale = $couvSociale;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Fichier[]
     */
    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function addFichier(Fichier $fichier): self
    {
        if (!$this->fichiers->contains($fichier)) {
            $this->fichiers[] = $fichier;
            $fichier->setUser($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $fichier): self
    {
        if ($this->fichiers->removeElement($fichier)) {
            // set the owning side to null (unless already changed)
            if ($fichier->getUser() === $this) {
                $fichier->setUser(null);
            }
        }

        return $this;
    }

   
}

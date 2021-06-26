<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 */
class RendezVous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("rv:read")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups("rv:read")
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups("rv:read")
     */
    private $Fname;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("rv:read")
     */
    private $Lname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups("rv:read")
     */
    private $Email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(string $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(?string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getFname(): ?string
    {
        return $this->Fname;
    }

    public function setFname(?string $Fname): self
    {
        $this->Fname = $Fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->Lname;
    }

    public function setLname(string $Lname): self
    {
        $this->Lname = $Lname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

   
}

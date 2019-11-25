<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Password", mappedBy="category", orphanRemoval=true)
     */
    private $passwords;

    /**
     * @ORM\Column(type="integer")
     */
    private $lft;

    /**
     * @ORM\Column(type="integer")
     */
    private $rght;

    /**
     * @ORM\Column(type="integer")
     */
    private $lvl;

    public function __construct()
    {
        $this->passwords = new ArrayCollection();
    }

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

    /**
     * @return Collection|Password[]
     */
    public function getPasswords(): Collection
    {
        return $this->passwords;
    }

    public function addPassword(Password $password): self
    {
        if (!$this->passwords->contains($password)) {
            $this->passwords[] = $password;
            $password->setCategory($this);
        }

        return $this;
    }

    public function removePassword(Password $password): self
    {
        if ($this->passwords->contains($password)) {
            $this->passwords->removeElement($password);
            // set the owning side to null (unless already changed)
            if ($password->getCategory() === $this) {
                $password->setCategory(null);
            }
        }

        return $this;
    }

    public function getLft(): ?int
    {
        return $this->lft;
    }

    public function setLft(int $lft): self
    {
        $this->lft = $lft;

        return $this;
    }

    public function getRght(): ?int
    {
        return $this->rght;
    }

    public function setRght(int $rght): self
    {
        $this->rght = $rght;

        return $this;
    }

    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    public function setLvl(int $lvl): self
    {
        $this->lvl = $lvl;

        return $this;
    }
}

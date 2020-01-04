<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmsRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"title"}, message="Ce film existe déjà dans la base")
 */
class Films
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2, max=100, minMessage="Le titre doit faire au moin 2 caractères",
     * maxMessage="Le titre ne doit pas dépasser les 100 caractères !")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=50, max=1000, minMessage="La description doit faire au moin 50 caractères")
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Url()
     */
    private $coverImage;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="films")
     * @Assert\Valid()
     * 
     */
    private $persons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Country", inversedBy="films")
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Autor", inversedBy="films")
     * @Assert\Valid()
     */
    private $autors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Year", inversedBy="films")
     */
    private $years;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Actor", inversedBy="films")
     * @Assert\Valid()
     */
    private $actors;



    

    public function __construct()
    {
        $this->persons = new ArrayCollection();
        $this->country = new ArrayCollection();
        $this->autors = new ArrayCollection();
        $this->years = new ArrayCollection();
        $this->actors = new ArrayCollection();
    }
  

    /**
     * Slug initialization
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initSlugFilms(){
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->title);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getPersons(): Collection
    {
        return $this->persons;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->persons->contains($person)) {
            $this->persons[] = $person;
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->persons->contains($person)) {
            $this->persons->removeElement($person);
        }

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->country->contains($country)) {
            $this->country[] = $country;
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->country->contains($country)) {
            $this->country->removeElement($country);
        }

        return $this;
    }

    /**
     * @return Collection|Autor[]
     */
    public function getAutors(): Collection
    {
        return $this->autors;
    }

    public function addAutor(Autor $autor): self
    {
        if (!$this->autors->contains($autor)) {
            $this->autors[] = $autor;
        }

        return $this;
    }

    public function removeAutor(Autor $autor): self
    {
        if ($this->autors->contains($autor)) {
            $this->autors->removeElement($autor);
        }

        return $this;
    }

    /**
     * @return Collection|Year[]
     */
    public function getYears(): Collection
    {
        return $this->years;
    }

    public function addYear(Year $year): self
    {
        if (!$this->years->contains($year)) {
            $this->years[] = $year;
        }

        return $this;
    }

    public function removeYear(Year $year): self
    {
        if ($this->years->contains($year)) {
            $this->years->removeElement($year);
        }

        return $this;
    }

    /**
     * @return Collection|Actor[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        if ($this->actors->contains($actor)) {
            $this->actors->removeElement($actor);
        }

        return $this;
    }  
    
}

<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeriesRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"title"}, message="Cette série existe déjà dans la base")
 */
class Series
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
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(min=50, max=1000, minMessage="La description doit faire au moin 50 caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $coverImage;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $seasons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="series")
     */
    private $persons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Country", inversedBy="series")
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Autor", inversedBy="series")
     */
    private $autors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Year", inversedBy="series")
     */
    private $years;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Actor", inversedBy="series")
     */
    private $actors;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="series")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="serie", orphanRemoval=true)
     */
    private $comments;




    public function __construct()
    {
        $this->persons = new ArrayCollection();
        $this->country = new ArrayCollection();
        $this->autors = new ArrayCollection();
        $this->years = new ArrayCollection();
        $this->actors = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getRating(){
        $s = array_reduce($this->comments->toArray(), function($total, $comment){
            return $total + $comment->getRate();
        }, 0);
        if(count($this->comments) > 0 ) return  $s /  count($this->comments);
        return 0;
    }

    /**
     * Slug initialization
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initSlugSeries(){
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

    public function getSeasons(): ?int
    {
        return $this->seasons;
    }

    public function setSeasons(int $seasons): self
    {
        $this->seasons = $seasons;

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setSerie($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getSerie() === $this) {
                $comment->setSerie(null);
            }
        }

        return $this;
    }

}

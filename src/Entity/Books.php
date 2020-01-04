<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BooksRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"title"}, message="Ce livre existe déjà dans la base")
 */
class Books
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
    private $pages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Writer", inversedBy="books")
     */
    private $writers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Editor", inversedBy="books")
     */
    private $editors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Year", inversedBy="books")
     * @Assert\Valid()
     */
    private $years;


    public function __construct()
    {
        $this->writers = new ArrayCollection();
        $this->editors = new ArrayCollection();
        $this->years = new ArrayCollection();
    }



   /**
     * Slug initialization
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initSlugBooks(){
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

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(int $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @return Collection|Writer[]
     */
    public function getWriters(): Collection
    {
        return $this->writers;
    }

    public function addWriter(Writer $writer): self
    {
        if (!$this->writers->contains($writer)) {
            $this->writers[] = $writer;
        }

        return $this;
    }

    public function removeWriter(Writer $writer): self
    {
        if ($this->writers->contains($writer)) {
            $this->writers->removeElement($writer);
        }

        return $this;
    }

    /**
     * @return Collection|Editor[]
     */
    public function getEditors(): Collection
    {
        return $this->editors;
    }

    public function addEditor(Editor $editor): self
    {
        if (!$this->editors->contains($editor)) {
            $this->editors[] = $editor;
        }

        return $this;
    }

    public function removeEditor(Editor $editor): self
    {
        if ($this->editors->contains($editor)) {
            $this->editors->removeElement($editor);
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

}

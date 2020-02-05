<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\YearRepository")
 */
class Year
{

    public function __toString()
    {
        return $this->date;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Films", mappedBy="years")
     */
    private $films;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Series", mappedBy="years")
     */
    private $series;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Books", mappedBy="years")
     */
    private $books;

    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->series = new ArrayCollection();
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Films[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Films $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
            $film->addYear($this);
        }

        return $this;
    }

    public function removeFilm(Films $film): self
    {
        if ($this->films->contains($film)) {
            $this->films->removeElement($film);
            $film->removeYear($this);
        }

        return $this;
    }

    /**
     * @return Collection|Series[]
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Series $series): self
    {
        if (!$this->series->contains($series)) {
            $this->series[] = $series;
            $series->addYear($this);
        }

        return $this;
    }

    public function removeSeries(Series $series): self
    {
        if ($this->series->contains($series)) {
            $this->series->removeElement($series);
            $series->removeYear($this);
        }

        return $this;
    }

    /**
     * @return Collection|Books[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Books $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addYear($this);
        }

        return $this;
    }

    public function removeBook(Books $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            $book->removeYear($this);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $rate;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Films", inversedBy="comments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Series", inversedBy="comments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $serie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Books", inversedBy="comments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;
    


    /**
     * Date de création
     * 
     * @ORM\PrePersist
     *
     * @return void
     */
    public function Persist(){
        if(empty($this->CreatedAt)){
            $this->createdAt = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getFilm(): ?Films
    {
        return $this->film;
    }

    public function setFilm(?Films $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getSerie(): ?Series
    {
        return $this->serie;
    }

    public function setSerie(?Series $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getBook(): ?Books
    {
        return $this->book;
    }

    public function setBook(?Books $book): self
    {
        $this->book = $book;

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
}

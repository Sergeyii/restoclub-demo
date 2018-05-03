<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    const CHOISE_TYPE_TYPICAL = 0;
    const CHOISE_TYPE_AUTHOR = 1;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
     * @ORM\JoinTable(name="article_tag_assigments",
     *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"title": "ASC"})
     * @Assert\Count(max="3", maxMessage="Макс. количество тегов не должно быть > 3")
     */
    private $tags;

    /**
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="ArticleAuthor", mappedBy="article",cascade={"persist"})
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", name="publicated_at")
     */
    private $publicatedAt;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /*public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(ArticleAuthor $author)
    {
        $this->author = $author;
        $author->setArticle($this);
        return $this;
    }*/

    public function addTag(?Tag ...$tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getPublicatedAt()
    {
        return $this->publicatedAt;
    }

    public function setPublicatedAt(?\DateTime $publicatedAt)
    {
        $this->publicatedAt = $publicatedAt;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }
}
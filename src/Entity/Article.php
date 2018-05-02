<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use \Doctrine\Common\Collections\ArrayCollection;

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

    private $authorInfo;

    private $tags;

    /*
    public function __construct() {
        $this->tags = new ArrayCollection();
    }*/


    /**
     * @ORM\Column(type="integer")
     */
    private $type;
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", name="publicated_at")
     */
    private $publicatedAt;

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthorFio()
    {
        return $this->authorFio;
    }

    /**
     * @param mixed $authorFio
     */
    public function setAuthorFio($authorFio)
    {
        $this->authorFio = $authorFio;
    }

    /**
     * @return mixed
     */
    public function getAuthorSiteUrl()
    {
        return $this->authorSiteUrl;
    }

    /**
     * @param mixed $authorSiteUrl
     */
    public function setAuthorSiteUrl($authorSiteUrl)
    {
        $this->authorSiteUrl = $authorSiteUrl;
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

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}

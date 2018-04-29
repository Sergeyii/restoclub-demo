<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $title;
    /**
     * @ORM\Column(type="string")
     */
    public $slug;
    /**
     * @ORM\Column(type="string")
     */
    public $authorFio;
    /**
     * @ORM\Column(type="string")
     */
    public $authorSiteUrl;
    /**
     * @ORM\Column(type="integer")
     */
    public $type;
    /**
     * @ORM\Column(type="text")
     */
    public $description;
    /**
     * @ORM\Column(type="datetime")
     */
    public $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    public $updatedAt;
    /**
     * @ORM\Column(type="datetime")
     */
    public $publicatedAt;
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleAuthorRepository")
 */
class ArticleAuthor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $fio;
    /**
     * @ORM\Column(type="string")
     */
    private $siteUrl;

    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="Article", inversedBy="author", cascade={"persist"})
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    public function getId()
    {
        return $this->id;
    }

    public function getFio()
    {
        return $this->fio;
    }

    public function setFio($fio): void
    {
        $this->fio = $fio;
    }

    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    public function setSiteUrl($siteUrl): void
    {
        $this->siteUrl = $siteUrl;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function setArticle($article): void
    {
        $this->article = $article;
    }
}
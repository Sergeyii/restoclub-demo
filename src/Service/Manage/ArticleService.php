<?php

namespace App\Service\Manage;

use App\Entity\Article;
use App\Entity\ArticleAuthor;
use App\Utils\Slugger;
use Doctrine\ORM\EntityManagerInterface;

class ArticleService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function add(Article $article)
    {
        $author = $article->getAuthor();

        //--Сохраняем article
        $article->setSlug(Slugger::slugify($article->getTitle()));

        $now = new \DateTime();
        $article->setCreatedAt($now);
        $article->setUpdatedAt($now);

        $this->em->persist($article);
        //--

        //--Сохраняем author
        $author->setArticle($article);
        $this->em->persist($author);
        //--

        $this->em->flush();
    }

    public function edit(Article $article)
    {
        //--Сохраняем article
        $article->setSlug(Slugger::slugify($article->getTitle()));
        $now = new \DateTime();
        $article->setUpdatedAt($now);
        $this->em->persist($article);
        //--

        $this->em->flush();
    }
}
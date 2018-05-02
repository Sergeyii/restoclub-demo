<?php

namespace App\Service\Manage;

use App\Entity\Article;
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
        $article->setSlug(Slugger::slugify($article->getTitle()));

        $now = new \DateTime();
        $article->setCreatedAt($now);
        $article->setUpdatedAt($now);

        $this->em->persist($article);
        $this->em->flush();
    }

    public function edit(Article $article)
    {
        $article->setSlug(Slugger::slugify($article->getTitle()));

        $now = new \DateTime();
        $article->setUpdatedAt($now);

        $this->em->persist($article);
        $this->em->flush();
    }
}
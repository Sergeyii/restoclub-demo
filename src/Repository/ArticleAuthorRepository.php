<?php

namespace App\Repository;

use App\Entity\ArticleAuthor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticleAuthor|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleAuthor|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleAuthor[]    findAll()
 * @method ArticleAuthor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleAuthorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleAuthor::class);
    }
}
<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Article[]
     * */
    public function findByTagSlug($slug): array
    {
        return $this->createQueryBuilder('p')
            // p.category refers to the "category" property on product
            ->innerJoin('p.tags', 'c')
            // selects all the category data to avoid the query
            ->addSelect('c')
            ->andWhere('c.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Article|null
     * */
    public function findByAuthorSlug($slug): ?Article
    {
        return $this->createQueryBuilder('p')
            // p.category refers to the "category" property on product
            ->innerJoin('p.author', 'c')
            // selects all the category data to avoid the query
            ->addSelect('c')
            ->andWhere('c.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

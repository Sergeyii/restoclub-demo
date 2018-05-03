<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/articles", name="articles")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'articles' => $this->repository->findAll(),
        ]);
    }

    /**
     * @Route("/article/{slug}", name="article_show")
     */
    public function show($slug)
    {
        return $this->render('article/show.html.twig', [
            'article' => $this->repository->findOneBy(['slug' => $slug]),
        ]);
    }

    /**
     * @Route("/article/tags/{slug}", name="articles_by_tag")
     */
    public function showByTag($slug)
    {
        return $this->render('article/index.html.twig', [
            'articles' => $this->repository->findByTagSlug($slug),
        ]);
    }

    /**
     * @Route("/article/authors/{id}", name="articles_by_author")
     */
    public function showByAuthor($id)
    {
        return $this->render('article/index.html.twig', [
            'articles' => $this->repository->findByAuthorSlug($id),
        ]);
    }
}

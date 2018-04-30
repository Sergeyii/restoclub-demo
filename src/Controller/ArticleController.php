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
     * @Route("/article/tags/{tag}", name="articles_by_tag")
     */
    public function showByTag($tag)
    {
        return $this->render('article/show_by_tag.html.twig', [
            'articles' => [],//TODO::
        ]);
    }

    /**
     * @Route("/article/authors/{author}", name="articles_by_author")
     */
    public function showByAuthor($author)
    {
        return $this->render('article/show_by_author.html.twig', [
            'articles' => [],//TODO::
        ]);
    }
}

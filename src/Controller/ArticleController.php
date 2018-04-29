<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
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
}

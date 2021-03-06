<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\Admin\ArticleType;
use App\Repository\ArticleRepository;
use App\Service\Manage\ArticleService;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class ArticleController extends BaseAdminController
{
    private $service;
    private $repository;

    public function __construct(ArticleService $service, ArticleRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function newAction()
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($this->request);

        if( $form->isSubmitted() && $form->isValid() ){
            try{
                $this->service->add($article);
                $this->addFlash('success', 'Модель создана!');
                return $this->redirectToRoute('admin');
            }catch(\DomainException $e){
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('admin/article/new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    public function editAction()
    {
        $entityId = $this->request->query->get('id');
        $article = $this->repository->find($entityId);

        if( !$article ){
            throw $this->createNotFoundException('Entity not found.');
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $this->service->edit($article);
                $this->addFlash('success', 'Модель обновлена!');
                return $this->redirectToRoute('admin', ['entity' => 'Article', 'action' => 'edit', 'id' => $article->getId()]);
            }catch(\DomainException $e){
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('admin/article/new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }
}
<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\Admin\TagType;
use App\Repository\TagRepository;
use App\Service\Manage\TagService;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class TagController extends BaseAdminController
{
    private $service;
    private $repository;

    public function __construct(TagService $service, TagRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function newAction()
    {
        $model = new Tag();
        $form = $this->createForm(TagType::class, $model);
        $form->handleRequest($this->request);

        if( $form->isSubmitted() && $form->isValid() ){
            try{
                $this->service->add($model);
                $this->addFlash('success', 'Модель создана!');
//                return $this->redirectToRoute('admin');
                return $this->redirectToRoute('admin', ['entity' => 'Tag']);
            }catch(\DomainException $e){
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('admin/tag/new.html.twig', array(
            'model' => $model,
            'form' => $form->createView(),
        ));
    }

    public function editAction()
    {
        $entityId = $this->request->query->get('id');
        $model = $this->repository->find($entityId);

        if( !$model ){
            throw $this->createNotFoundException('Entity not found.');
        }

        $form = $this->createForm(TagType::class, $model);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $this->service->edit($model);
                $this->addFlash('success', 'Модель обновлена!');
                return $this->redirectToRoute('admin', ['entity' => 'Tag', 'action' => 'edit', 'id' => $model->getId()]);
            }catch(\DomainException $e){
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('admin/tag/new.html.twig', array(
            'model' => $model,
            'form' => $form->createView(),
        ));
    }
}
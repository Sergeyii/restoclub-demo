<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function updateEntity($entity)
    {
        //TODO::не срабатывает!
        $this->updateSlug($entity);
        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new \DateTime());
        }

        parent::updateEntity($entity);
    }

    private function updateSlug($entity)
    {
        if (method_exists($entity, 'setSlug') and method_exists($entity, 'getTitle')) {
            $entity->setSlug($this->get('app.slugger')->slugify($entity->getTitle()));
        }
    }
}
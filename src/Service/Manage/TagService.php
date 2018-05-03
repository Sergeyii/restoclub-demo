<?php

namespace App\Service\Manage;

use App\Entity\Tag;
use App\Utils\Slugger;
use Doctrine\ORM\EntityManagerInterface;

class TagService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function add(Tag $model)
    {
        $model = $this->setDefaultsWhenAdding($model);

        $this->em->persist($model);
        $this->em->flush();
    }

    public function setDefaultsWhenAdding(Tag $model)
    {
        $model->setTitle($model->getTitle());
        $model->setSlug(Slugger::slugify($model->getTitle()));
        $model->setCreatedAt(new \DateTime());
        return $model;
    }

    public function edit(Tag $model)
    {
        $model->setSlug(Slugger::slugify($model->getTitle()));
        $this->em->persist($model);
        $this->em->flush();
    }
}
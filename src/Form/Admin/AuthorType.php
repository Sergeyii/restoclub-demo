<?php

namespace App\Form\Admin;

use App\Entity\ArticleAuthor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fio', TextType::class, ['label' => 'Название'])
            ->add('siteUrl', UrlType::class, [
                'label' => 'Url на сайт автора',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'     => ArticleAuthor::class,
            'error_bubbling' => false,
        ));
    }
}
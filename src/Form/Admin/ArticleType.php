<?php

namespace App\Form\Admin;

use App\Entity\Article;
use App\Form\Type\DateTimePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Название'])
//            ->add('slug', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => $this->getChoices(),
                'label' => 'Тип статьи'
            ])
            ->add('description', TextareaType::class, ['label' => 'Описание', 'required' => false])

            /*->add('publicatedAt', DateTimePickerType::class, [
                'label' => 'Опубликовано',
            ])//TODO::почему-то автоматом не показывает значение в форме редактирования
            */
            ->add('publicatedAt', DateTimeType::class, [
                'label' => 'Опубликовано',
            ])
//            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }

    private function getChoices()
    {
        return [
            'Обычная' => Article::CHOISE_TYPE_TYPICAL,
            'Авторская' => Article::CHOISE_TYPE_AUTHOR,
        ];
    }
}
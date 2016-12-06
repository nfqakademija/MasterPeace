<?php

namespace MasterPeace\Bundle\QuizBundle\Form;

use MasterPeace\Bundle\QuizBundle\Factory\QuestionFactory;
use MasterPeace\Bundle\QuizBundle\Form\QuestionType;
use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'quiz.create.title.label',
            ])
            ->add('questions', CollectionType::class, [
                'entry_type' => QuestionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype_data' => QuestionFactory::create(),
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'quiz.create.save.button',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}

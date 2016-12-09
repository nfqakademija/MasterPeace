<?php

namespace MasterPeace\Bundle\QuizBundle\Form;

use MasterPeace\Bundle\QuizBundle\Entity\Question;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer;
use MasterPeace\Bundle\QuizBundle\Form\Subscriber\AddAnswerFieldSubscriber;
use MasterPeace\Bundle\QuizBundle\Form\Transformer\AnswerTransformer;
use MasterPeace\Bundle\QuizBundle\Form\Transformer\CorrectAnswerTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizResultAnswerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new AddAnswerFieldSubscriber());
        $builder->addModelTransformer(new CorrectAnswerTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuizResultAnswer::class,
            'label' => false,
        ]);
    }
}
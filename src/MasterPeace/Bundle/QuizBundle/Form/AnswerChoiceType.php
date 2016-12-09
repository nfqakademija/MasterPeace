<?php

namespace MasterPeace\Bundle\QuizBundle\Form;

use MasterPeace\Bundle\QuizBundle\Entity\Answer;
use MasterPeace\Bundle\QuizBundle\Form\Transformer\AnswerTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerChoiceType extends AbstractType
{
    /**
     * @var AnswerTransformer
     */
    private $transformer;

    /**
     * AnswerChoiceType constructor.
     *
     * @param AnswerTransformer $transformer
     */
    public function __construct(AnswerTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->transformer);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'expanded' => true,
            'multiple' => false,
            'data_class' => Answer::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
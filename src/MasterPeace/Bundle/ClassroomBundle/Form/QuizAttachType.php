<?php

namespace MasterPeace\Bundle\ClassroomBundle\Form;

use Doctrine\ORM\EntityRepository;
use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizAttachType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quizzes', EntityType::class, [
                'class' => Quiz::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('b')  // TODO: Istraukti tik savo sukurtus quizus
                        ->orderBy('b.title', 'ASC');
                },
                'placeholder' => 'classroom.view.select_quiz.placeholder',
                'label' => false,
                'multiple' => false,
                'required' => true,
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class,
        ]);
    }
}

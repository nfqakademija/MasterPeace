<?php

namespace MasterPeace\Bundle\ClassroomBundle\Form;

use Doctrine\ORM\EntityRepository;
use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('quiz', EntityType::class, [
                'class' => Quiz::class,
                'required' => true,
                'empty_data' => new Quiz(),
                'query_builder' => function (EntityRepository $er) use ($options) {
                    $qb = $er->createQueryBuilder('q');

                    if ($options['teacher']) {
                        $qb
                            ->where($qb->expr()->eq('q.teacher', ':teacher'))
                            ->setParameter('teacher', $options['teacher']);
                    }

                    $qb->orderBy('q.title', 'ASC');

                    return $qb;
                },
                'placeholder' => 'classroom.view.select_quiz.placeholder',
                'label' => false,
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'teacher' => null,
        ]);
    }
}

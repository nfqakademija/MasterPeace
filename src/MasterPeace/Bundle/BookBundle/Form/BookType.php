<?php

namespace MasterPeace\Bundle\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('author', TextType::class)
            ->add('year', IntegerType::class)
            ->add('publisher', TextType::class)
            ->add('cover', FileType::class, [
                'required' => false
            ])
            ->add('isbnCode', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Add New Book'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MasterPeace\Bundle\BookBundle\Entity\Book',
        ));
    }
}

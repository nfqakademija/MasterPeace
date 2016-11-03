<?php

namespace MasterPeace\Bundle\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('author')
            ->add('year')
            ->add('publisher')
            ->add('cover')
            ->add('isbnCode')
            ->add('save', SubmitType::class);
    }
}

<?php

namespace MasterPeace\Bundle\BookBundle\Form;

use MasterPeace\Bundle\BookBundle\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'book.create.title.label',
            ])
            ->add('author', TextType::class, [
                'label' => 'book.create.author.label',
            ])
            ->add('year', IntegerType::class, [
                'label' => 'book.create.year.label',
            ])
            ->add('publisher', TextType::class, [
                'label' => 'book.create.publisher.label',
            ])
//            ->add('cover', FileType::class, [
//                'label' => 'book.create.cover.label',  // TODO: add COVER usage
//            ])
            ->add('isbnCode', TextType::class, [
                'label' => 'book.create.isbn_code.label',
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}

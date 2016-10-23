<?php

namespace UpRead\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UpRead\BookBundle\Entity\Book;

class LoadBookData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getBook() as $item => $book) {
            $bookDetail = new Book();
            $bookDetail->setTitle($book['title'])
                ->setAuthor($book['author'])
                ->setYear($book['year'])
                ->setPublisher($book['publisher'])
                ->setCover('')
                ->setIsbnCode($book['isbnCode']);
            $manager->persist($bookDetail);
            $manager->flush();
        }
    }

    private function getBook()
    {
        $bookList = array();

        $bookList[] = array(
            'title' => 'Nesustabdomas. Ko galime pasiekti tikėdami. Tikra istorija',
            'author' => 'Nick Vujicic',
            'year' => 2016,
            'publisher' => 'Alma Littera',
            'cover' => '',
            'isbnCode' => 9786090124680
        );

        $bookList[] = array(
            'title' => 'Smaragdo akies paslaptis',
            'author' => 'Džeronimas Stiltonas',
            'year' => 2013,
            'publisher' => 'Baltų lankų leidyba',
            'cover' => '',
            'isbnCode' => 9789955236788
        );

        $bookList[] = array(
            'title' => 'Prisukamo paukščio kronikos',
            'author' => 'Haruki Murakami',
            'year' => 2016,
            'publisher' => 'Baltų lankų leidyba',
            'cover' => '',
            'isbnCode' => 9786090124680
        );

        return $bookList;
    }
}

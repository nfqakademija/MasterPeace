<?php

namespace MasterPeace\Bundle\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\BookBundle\Entity\Book;

class LoadBookData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getBookDetails() as $bookDetail) {
            $book = new Book();
            $book
                ->setTitle($bookDetail['title'])
                ->setAuthor($bookDetail['author'])
                ->setYear($bookDetail['year'])
                ->setPublisher($bookDetail['publisher'])
                ->setCover($bookDetail['cover'])
                ->setIsbnCode($bookDetail['isbn_code']);
            $manager->persist($book);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private function getBookDetails()
    {
        return [
            [
            'title' => 'Nesustabdomas. Ko galime pasiekti tikėdami. Tikra istorija',
            'author' => 'Nick Vujicic',
            'year' => 2016,
            'publisher' => 'Alma Littera',
            'cover' => '',
            'isbn_code' => 9786090124680,
            ],
            [
            'title' => 'Smaragdo akies paslaptis',
            'author' => 'Džeronimas Stiltonas',
            'year' => 2013,
            'publisher' => 'Baltų lankų leidyba',
            'cover' => '',
            'isbn_code' => 9789955236788,
            ],
            [
            'title' => 'Prisukamo paukščio kronikos',
            'author' => 'Haruki Murakami',
            'year' => 2016,
            'publisher' => 'Baltų lankų leidyba',
            'cover' => '',
            'isbn_code' => 9789955232520,
            ],
        ];
    }
}

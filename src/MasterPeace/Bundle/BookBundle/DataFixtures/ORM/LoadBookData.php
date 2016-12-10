<?php

namespace MasterPeace\Bundle\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\BookBundle\Entity\Book;

class LoadBookData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::getBookDetails() as $id => $bookDetail) {
            $book = new Book();
            $book
                ->setTeacher($this->getReference('user1'))
                ->setTitle($bookDetail['title'])
                ->setAuthor($bookDetail['author'])
                ->setYear($bookDetail['year'])
                ->setPublisher($bookDetail['publisher'])
                ->setCover($bookDetail['cover'])
                ->setIsbnCode($bookDetail['isbn_code']);
            $manager->persist($book);

            $this->addReference('book' . $id, $book);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private static function getBookDetails(): array
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

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 1;
    }

    /**
     * @return int
     */
    public static function getBookCount(): int
    {
        return count(self::getBookDetails());
    }
}

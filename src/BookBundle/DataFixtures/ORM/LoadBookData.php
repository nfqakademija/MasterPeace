<?php

namespace BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BookBundle\Entity\Book;

class LoadBookData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $book1 = new Book();
        $book1->setTitle('Nesustabdomas. Ko galime pasiekti tikėdami. Tikra istorija');
        $book1->setAuthor('Nick Vujicic');
        $book1->setYear('2016');
        $book1->setPublisher('Alma Littera');
        $book1->setCover('');
        $book1->setIsbnCode('9786090124680');
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setTitle('Smaragdo akies paslaptis');
        $book2->setAuthor('Džeronimas Stiltonas');
        $book2->setYear('2013');
        $book2->setPublisher('Baltų lankų leidyba');
        $book2->setCover('');
        $book2->setIsbnCode('9789955236788');
        $manager->persist($book2);

        $book3 = new Book();
        $book3->setTitle('Prisukamo paukščio kronikos');
        $book3->setAuthor('Haruki Murakami');
        $book3->setYear('2016');
        $book3->setPublisher('Baltų lankų leidyba');
        $book3->setCover('');
        $book3->setIsbnCode('9789955232520');
        $manager->persist($book3);

        $manager->flush();
    }
}

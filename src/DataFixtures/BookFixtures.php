<?php


namespace App\DataFixtures;


use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $book = $this->createBook("La république", "Platon", 10);
        $manager->persist($book);

        $book = $this->createBook("Le Banquet", "Platon", 13);
        $manager->persist($book);

        $book = $this->createBook("Three men in boat", "Jerome K Jerome", 15);
        $manager->persist($book);

        $book = $this->createBook("Vernon Subutex", "V. Despentes", 20);
        $manager->persist($book);

        $book = $this->createBook("Dune", "Franck Herbert", 25);
        $manager->persist($book);

        $manager->flush();
    }

    private function createBook($title, $author, $price) {
        $book = new Book();
        $book->setTitle($title)->setAuthor($author)->setPrice($price);
        return $book;
    }

}
<?php


namespace App\DataFixtures;


use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $book = $this->createBook("La république", "Platon", 10, "Hachette");
        $manager->persist($book);

        $book = $this->createBook("Le Banquet", "Platon", 13, "Gallimard");
        $manager->persist($book);

        $book = $this->createBook("Three men in boat", "Jerome K Jerome", 15, "Flammarion");
        $manager->persist($book);

        $book = $this->createBook("Vernon Subutex", "V. Despentes", 20, "Milan");
        $manager->persist($book);

        $book = $this->createBook("Dune", "Franck Herbert", 25, "Beaudelaire");
        $manager->persist($book);

        $manager->flush();
    }

    private function createBook($title, $author, $price, $publisher) {
        $book = new Book();
        $book->setTitle($title)->setAuthor($author)->setPrice($price)->setPublisher($this->getReference("publisher_$publisher"));
        return $book;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
          PublisherFixtures::class
        ];
    }
}
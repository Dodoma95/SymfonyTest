<?php


namespace App\DataFixtures;


use App\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PublisherFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $publisher = $this->createPublisher("Hachette", "hachette@example.com", "www.hachette.com");
        $manager->persist($publisher);

        $publisher = $this->createPublisher("Gallimard", "gallimard@example.com", "www.gallimard.com");
        $manager->persist($publisher);

        $publisher = $this->createPublisher("Flammarion", "flammarion@example.com", "www.flammarion.com");
        $manager->persist($publisher);

        $publisher = $this->createPublisher("Milan", "milan@example.com", "www.milan.com");
        $manager->persist($publisher);

        $publisher = $this->createPublisher("Beaudelaire", "beaudelaire@example.com", "www.beaudelaire.com");
        $manager->persist($publisher);

        $manager->flush();
    }

    private function createPublisher($name, $email, $website) {
        $publisher = new Publisher();
        $publisher->setName($name)->setEmail($email)->setWebsite($website);
        //addReference permet de faire le lien avec la FK située dans la table book
        $this->addReference("publisher_$name", $publisher);
        return $publisher;
    }
}
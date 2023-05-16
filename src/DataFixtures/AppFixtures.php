<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Catalogue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i <= 20 ; $i++) {
            $idUser = $i+1;
            $article = new Article();
            $article->setUserId($idUser)
                ->setImage('https://www.kitesurf.fr/shop/8105-large_default/surf-signature-bambou-2014-d-occasion.jpg')
                ->setNom("article $i")
                ->setIsAvailable(true);

            $catalogue = new Catalogue();
            $catalogue->setUserId($idUser)
                ->addArticle($article);

            $manager->persist($article);
            $manager->persist($catalogue);
        }

        $manager->flush();
    }
}

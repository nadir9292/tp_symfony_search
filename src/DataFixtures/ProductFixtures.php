<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product
                ->setName("Product $i")
                ->setPrice(rand(1, 1000));
            $manager->persist($product);
        }
        $manager->flush();
    }
}

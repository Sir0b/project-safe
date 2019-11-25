<?php

namespace App\DataFixtures;

use App\Entity\Password;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($x=0; $x < 5 ; $x++) { 
            $password = new Password();
            $password->setName("name $x");
            $password->setUrl("url $x");
            $password->setEmail("email $x");
            $password->setUsername("username $x");
            $password->setValue("value $x");
            
            $manager->persist($password);
        }

        $manager->flush();
    }
}

<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\PositionPlayer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class PositionPlayerFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $arrayPositions = [
            'Вратарь',
            'Защитник',
            'Полузащитник',
            'Нападающий',
        ];
        foreach($arrayPositions as $name) {
            $position = new PositionPlayer();
            $position->setName($name);
            $manager->persist($position);
        }
        $manager->flush();
    }
}
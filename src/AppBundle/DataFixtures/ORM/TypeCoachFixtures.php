<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\TypeCoach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class TypeCoachFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $arrayPositions = [
            'Главный тренер',
            'старший тренер',
            'Тренер',
            'Тренер-вратарей',
        ];

        foreach($arrayPositions as $name) {
            $position = new TypeCoach();
            $position->setName($name);
            $manager->persist($position);
        }
        $manager->flush();
    }
}
<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Page\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class TeamFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $arrayTeams = [
            'Нац сборная КР',
            'Олимпийская сборная КР',
            'Молодежная сборная сборная КР',
            'Юношеская сборная сборная КР',
        ];

        foreach($arrayTeams as $nameTeam) {
            $team = new Team();
            $team
                ->setTitle($nameTeam)
                ->setSubtitle($faker->title)
                ->setDescription($faker->text);
            $manager->persist($team);
        }
        $manager->flush();
    }
}
<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Page\Team;
use AppBundle\Entity\TypeCoach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class CoachFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $types = $manager->getRepository(TypeCoach::class)->findAll();
        $teams = $manager->getRepository(Team::class)->findAll();

        for($i = 0; $i < 10; $i++) {
            $coach = new Coach();
            $coach
                ->setFullName($faker->name)
                ->setBirthday($faker->dateTime( $max = 'now'))
                ->setBiography($faker->text)
                ->addType($types[rand(0,3)])
                ->addTeam($teams[rand(0,3)])
            ;
            $manager->persist($coach);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TypeCoachFixtures::class,
            TeamFixtures::class
        ];
    }
}
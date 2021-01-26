<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Page\Team;
use AppBundle\Entity\Page\TeamGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class TeamGroupFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $groupNames = [
          'Футбол',
          'Футзал',
          'Женский футбол',
        ];
        $teams = $manager->getRepository(Team::class)->findAll();

        foreach($groupNames as $key => $name) {
            $group = new TeamGroup();
            $group
                ->setTitle($name)
                ->setSubtitle($faker->title)
                ->setDescription($faker->text)
                ->addTeam($teams[rand(0,3)])
            ;
            $manager->persist($group);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TeamFixtures::class
        ];
    }
}
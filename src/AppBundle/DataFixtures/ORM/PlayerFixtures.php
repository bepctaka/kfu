<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Page\Team;
use AppBundle\Entity\Player;
use AppBundle\Entity\PositionPlayer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class PlayerFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $position = $manager->getRepository(PositionPlayer::class)->findAll();
        $teams = $manager->getRepository(Team::class)->findAll();

        for($i = 0; $i < 20; $i++) {
            $player = new Player();
            $player
                ->setFullName($faker->name)
                ->setBirthday($faker->dateTime( $max = 'now'))
                ->setBiography($faker->text)
                ->setDebut($faker->dateTime( $max = 'now'))
                ->setAmountGames($faker->numberBetween($min = 1, $max = 200))
                ->setAmountGoals($faker->numberBetween($min = 1, $max = 200))
                ->addPosition($position[rand(0,3)])
                ->addTeam($teams[rand(0,3)])
            ;
            $manager->persist($player);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            PositionPlayerFixtures::class,
            TeamFixtures::class
        ];
    }
}
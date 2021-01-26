<?php

namespace AppBundle\Twig;

use AppBundle\Entity\OnlineMatch;
use AppBundle\Entity\Page\Menu;
use AppBundle\Entity\Slider;
use Doctrine\ORM\EntityManagerInterface;

class MenuTwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Returns a list of global variables to add to the existing list.
     *
     * @return array An array of global variables
     */
    public function getGlobals()
    {
        $data['mine_menu'] = $this->em->getRepository(Menu::class)->findAll();
        $data['sliders'] = $this->em->getRepository(Slider::class)->findBy([
            'isActive' => true
        ]);
        $data['onlineMatches'] = $this->em->getRepository(OnlineMatch::class)->findBy([
            'isActive' => true
        ]);
        return $data;
    }

    public function getTests() {
        return array(
            new \Twig_SimpleTest('instanceof', array($this, 'isInstanceOf')),
        );
    }

    public function isInstanceOf($var, $instance) {
        return  $var instanceof $instance;
    }
}
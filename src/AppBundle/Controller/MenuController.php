<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Entity\Page\Menu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MenuController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/{_locale}/{slug}/show-menu-items", name="showMenuItems")
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showMenuAction(string $slug)
    {
        $menu = $this->em->getRepository(Menu::class)->findOneBy([
            'slug' => $slug
        ]);


        return $this->render('menu/show.html.twig', [
            'menu' => $menu
        ]);
    }


}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gallery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GalleryController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/{_locale}/galleries", name="showGalleries")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $galleries = $this->em->getRepository(Gallery::class)->findBy([], [
            'id' => 'DESC'
        ]);

        return $this->render('gallery/index.html.twig', [
            'galleries' => $galleries
        ]);
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClubForTournamentTable;
use AppBundle\Entity\FutureMatch;
use AppBundle\Entity\Gallery;
use AppBundle\Entity\Page\News;
use AppBundle\Entity\TournamentTable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/{_locale}", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $limit=14;
        $news = $this->getDoctrine()->getRepository(News::class)->findBy([],[
            'id' => 'DESC'
        ]);
        $futureMatches = $this->getDoctrine()->getRepository(FutureMatch::class)->findBy([
            'isActive' => true
        ]);
        $galleries = $this->getDoctrine()->getRepository(Gallery::class)->findBy([
            'isActive' => true
        ]);
        $tournamentTables = $this->getDoctrine()->getRepository(TournamentTable::class)->findBy([
            'isActive' => true
        ]);

        $futureMatchesArr = [];
        $array = [];
        $count = 0;
        $lastIndex = count($futureMatches) - 1;
        foreach ($futureMatches as $key => $val) {
            if ($count < 4) {
                $array[] = $val;
                $count++;
            } else {
                $futureMatchesArr[] = $array;
                $array = [];
                $count = 1;
                $array[] = $val;
            }
            if ($key === $lastIndex) {
                $futureMatchesArr[] = $array;
            }
        }
        return $this->render('home/index.html.twig', [
            'news' => $news,
            'limit'=> $limit,
            'galleries' => $galleries,
//            'futureMatches' => $futureMatches,
            'tournamentTables' => $tournamentTables,
            'futureMatchesArr' => $futureMatchesArr
        ]);
    }
    /**
     * @Route("/{_locale}/newsLoadMore", name="newsLoadMore")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newsLoadMore(Request $request)
    {

        $news = $this->getDoctrine()->getRepository(News::class)->findBy([],[
            'id' => 'DESC'
        ]);
        return $this->render('partials/news_list.html.twig', [
            'news' => $news,
            'limit'=>$request->query->get('_limit', 14) ,
        ]);
    }
    
    /**
     * @Route("/{_locale}/newsByTheme", name="newsByTheme")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newsByTheme(Request $request)
    {

        $limit=15;
        $news = $this->getDoctrine()->getRepository(News::class)->findBy(['foothall'=>true],[
            'id' => 'DESC'
        ]);
        return $this->render('page/news_by_theme.html.twig', [
            'news' => $news,
            'limit'=> $request->query->get('_limit', 15) ,
        ]);
    }

    /**
     * @Route("/{_locale}/newsLoadMoreByTheme", name="newsLoadMoreByTheme")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newsLoadMoreByTheme(Request $request)
    {

        $news = $this->getDoctrine()->getRepository(News::class)->findBy(['foothall'=>true],[
            'id' => 'DESC'
        ]);
        return $this->render('partials/news_list_by_theme.html.twig', [
            'news' => $news,
            'limit'=>$request->query->get('_limit', 15) ,
        ]);
    }
}
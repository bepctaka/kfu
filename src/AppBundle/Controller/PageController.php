<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Entity\Page\BasePage;
use AppBundle\Entity\Page\News;
use AppBundle\Entity\Page\Vacancy;
use AppBundle\Entity\Page\Wallpaper;
use AppBundle\Entity\Summary;
use AppBundle\Form\SummaryType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class PageController extends Controller
{
    private $translator;
    private $em;

    public function __construct(TranslatorInterface $translator, EntityManagerInterface $em)
    {
        $this->translator = $translator;
        $this->em = $em;
    }

    /**
     * @Route("/{_locale}/{slug}/show", name="showPage")
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPageAction(string $slug)
    {
        $page = $this->em->getRepository(BasePage::class)->findOneBy([
            'slug' => $slug
        ]);
        return $this->render('page/show.html.twig', [
            'page' => $page,
        ]);
    }

    /**
     * @Route("/{_locale}/show-videos", name="showVideos")
     * @param string $entityName
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function getVideoAction()
    {
        $video = $this->em->getRepository('AppBundle:Page\Video')->findBy([], [
            'id' => 'DESC'
        ]);

        return $this->render('video/index.html.twig', [
            'items' => $video,
        ]);
    }
    /**
     * @Route("/{_locale}/{slug}/show-news", name="showNews")
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showNewsAction(string $slug)
    {

        $page = $this->em->getRepository(BasePage::class)->findOneBy([
            'slug' => $slug
        ]);

        $news = $this->getDoctrine()->getRepository(News::class)->findOneBy([
            'id' => $page->getId()
        ]);

        return $this->render('page/show_news.html.twig', [
            'page' => $page,
            'news'=> $news
        ]);
    }

    /**
     * @Route("/{_locale}/{slug}/show-pages", name="showPages")
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPagesAction(string $slug)
    {
        if($slug == 'novosti') return $this->redirectToRoute('newsByTheme');

        $page = $this->em->getRepository(BasePage::class)->findOneBy([
            'slug' => $slug
        ]);

        if ($slug == 'partnery') {
            return $this->render('page/chief_or_partners.html.twig', [
                'page' => $page,
            ]);
        }
        if ($slug == 'dokumenty') {
            $documents= $this->getDoctrine()->getRepository(Document::class)->findBy([],[
                'id' => 'DESC'
            ]);
            return $this->render('page/document.html.twig', [
                'page' => $page,
                'documents' => $documents,
            ]);
        }

        return $this->render('page/show_pages.html.twig', [
            'page' => $page,
        ]);
    }


    /**
     * @Route("/{_locale}/create-summary", name="creatSummary")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws EntityNotFoundException
     */
    public function createSummaryAction(Request $request)
    {
        $data = $request->query->all();
        if ($request->isMethod('post')) {
            $data = $request->request->all();
        }
        $slug = isset($data['slug']) ? $data['slug'] : null;
        $vacancy = $this->em->getRepository(Vacancy::class)->findOneBy([
            'slug' => $slug
        ]);

        if (!$vacancy) {
            throw new EntityNotFoundException('vacancy not found', 404);
        }

        if ($request->isMethod('post') && $request->isXmlHttpRequest()) {
            $array = $request->request->all();
            unset($array['slug']);
            unset($array['vacancy']);
            $summary = new Summary();
            $form = $this->createForm(SummaryType::class, $summary);
            $form->submit($array);
            if ($form->isValid()) {
                $summary->setVacancy($vacancy);
                $this->em->persist($summary);
                $this->em->flush();
                return $this->json([], 201);
            }
            return $this->json([
                'errors' => $this->getErrorMessages($form)
            ], 400);
        }

        return $this->json([
            'view' => $this->render('vacancy/form.html.twig', [
                'vacancy' => $vacancy
            ])->getContent()
        ]);
    }

    /**
     * @Route("/{_locale}/search-page", name="searchPage", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function searchAction(Request $request)
    {
        $pages = [];
        if (!empty($request->request->get('string'))) {
            $pages = $this->em->getRepository(BasePage::class)->searchByString((string)$request->request->get('string'));
        }
        return $this->json([
            'view' => $this->render('search/index.html.twig', [
                'pages' => $pages
            ])->getContent()
        ], 200);

    }

    public function getErrorMessages(Form $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $key => $error) {
            if ($form->isRoot()) {
                $errors['#'][] = $error->getMessage();
            } else {
                $errors[] = $error->getMessage();
            }
        }
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }
        return $errors;
    }
}
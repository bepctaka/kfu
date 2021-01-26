<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Page\Team;
use AppBundle\Entity\Page\TeamGroup;
use AppBundle\Entity\Player;
use AppBundle\Entity\PositionPlayer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class TeamGroupController extends Controller
{
    private $translator;

    private $em;

    public function __construct(TranslatorInterface $translator, EntityManagerInterface $em)
    {
        $this->translator = $translator;
        $this->em = $em;
    }

    /**
     * @Route("/{_locale}/{slug}/show-teams", name="showTeams")
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showTeamsAction(string $slug)
    {
        $teamGroup = $this->em->getRepository(TeamGroup::class)->findOneBy([
            'slug' => $slug
        ]);
        return $this->render('team_group/show_teams.html.twig', [
            'teamGroup' => $teamGroup,
            'title' => $this->translator->trans('TeamGroup')
        ]);
    }

    /**
     * @Route("/{_locale}/{slug}/show-team", name="showTeam")
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showTeamAction(string $slug)
    {
        $team =  $this->em->getRepository(Team::class)->findOneBy([
            'slug' => $slug
        ]);

        return $this->render('team_group/team/show_team.html.twig', [
            'team' => $team,
        ]);
    }

    /**
     * @Route("/{_locale}/get-coach/{teamId}", name="getCoaches", methods={"GET"})
     * @param int $teamId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCoachesAction(int $teamId)
    {
        $team =  $this->em->getRepository(Team::class)->find($teamId);

        return $this->json([
            'view' => $this->render('team_group/team/coach/coaches.html.twig', [
                'coaches' => $team->getCoaches()
            ])->getContent()
        ], 200);
    }

    /**
     * @Route("/{_locale}/get-players", name="getPlayers")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getPlayersAction(Request $request)
    {
        $data = $request->query->all();
        $teamId = $data['teamId'];
        $positionId = isset($data['positionId']) ? $data['positionId'] : null;
        $players =  $this->em->getRepository(Player::class)->getAllPlayers($teamId, $positionId);
        $positions =  $this->em->getRepository(PositionPlayer::class)->findAll();

        return $this->json([
            'view' => $this->render('team_group/team/players/players.html.twig', [
                'teamId' => $teamId,
                'players' => $players,
                'positions' => $positions
            ])->getContent()
        ]);
    }

    /**
     * @Route("/{_locale}/show-coach/{id}", name="showCoach")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCoachAction(int $id)
    {
        $coach =  $this->em->getRepository(Coach::class)->find($id);

        return $this->render('team_group/team/coach/show.html.twig', [
            'coach' => $coach
        ]);
    }
    /**
     * @Route("/{_locale}/show-player/{id}", name="showPlayer")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPlayer(int $id)
    {
        $player =  $this->em->getRepository(Player::class)->find($id);

        return $this->render('team_group/team/players/show.html.twig', [
            'player' => $player
        ]);
    }



}
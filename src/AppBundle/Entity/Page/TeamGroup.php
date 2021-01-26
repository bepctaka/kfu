<?php

namespace AppBundle\Entity\Page;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TeamGroup
 *
 * @ORM\Table(name="group_team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupTeamRepository")
 */
class TeamGroup extends BasePage
{
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Page\Team", mappedBy="teamGroup")
     */
    private $teams;

    /**
     * Add team.
     *
     * @param \AppBundle\Entity\Page\Team $team
     *
     * @return TeamGroup
     */
    public function addTeam(\AppBundle\Entity\Page\Team $team)
    {
        $this->teams[] = $team;
        $team->addTeamGroup($this);

        return $this;
    }

    /**
     * Remove team.
     *
     * @param \AppBundle\Entity\Page\Team $team
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTeam(\AppBundle\Entity\Page\Team $team)
    {
        $team->removeTeamGroup($this);
        return $this->teams->removeElement($team);
    }

    /**
     * Get teams.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }
}

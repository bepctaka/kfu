<?php

namespace AppBundle\Entity\Page;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MenuRepository")
 */
class Menu extends BasePage
{
    /**
     * @var boolean
     * @ORM\Column(name="is_vacancy", type="boolean")
     */
    private $isVacancy;

    /**
     * @var boolean
     * @ORM\Column(name="is_team_group", type="boolean")
     */
    private $isTeamGroup;

    /**
     * @return bool
     */
    public function isVacancy()
    {
        return $this->isVacancy;
    }

    /**
     * @param bool $isVacancy
     */
    public function setIsVacancy(bool $isVacancy)
    {
        $this->isVacancy = $isVacancy;
    }

    /**
     * @return bool
     */
    public function isTeamGroup()
    {
        return $this->isTeamGroup;
    }

    /**
     * @param bool $isTeamGroup
     */
    public function setIsTeamGroup(bool $isTeamGroup)
    {
        $this->isTeamGroup = $isTeamGroup;
    }


    /**
     * Get isVacancy.
     *
     * @return bool
     */
    public function getIsVacancy()
    {
        return $this->isVacancy;
    }

    /**
     * Get isTeamGroup.
     *
     * @return bool
     */
    public function getIsTeamGroup()
    {
        return $this->isTeamGroup;
    }
}

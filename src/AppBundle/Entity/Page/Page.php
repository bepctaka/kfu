<?php

namespace AppBundle\Entity\Page;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 *
 * @ORM\Table(name="pages")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PagesRepository")
 */
class Page extends BasePage
{
    /**
     * @var boolean
     * @ORM\Column(name="is_chief", type="boolean", nullable=true)
     */
    private $isChief;

    /**
     * @return bool
     */
    public function isChief()
    {
        return $this->isChief;
    }

    /**
     * @param bool $isChief
     */
    public function setIsChief(bool $isChief): void
    {
        $this->isChief = $isChief;
    }
}

<?php

namespace AppBundle\Entity\Page;

use AppBundle\Entity\Coach;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Team
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 * @Vich\Uploadable
 */
class Team extends BasePage
{
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Player", mappedBy="team")
     */
    private $players;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Coach", mappedBy="team")
     */
    private $coaches;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Page\TeamGroup", inversedBy="teams")
     */
    private $teamGroup;

    /**
     * @ORM\Column(name="logo", type="string", nullable=true)
     */
    private $logo;
    /**
     * @ORM\Column(name="amount_games", type="integer", nullable=true)
     */
    private $amountGames;
    /**
     * @ORM\Column(name="amount_wins", type="integer", nullable=true)
     */
    private $amountWins;
    /**
     * @ORM\Column(name="amount_drawn", type="integer", nullable=true)
     */
    private $amountDrawn;
    /**
     * @ORM\Column(name="amount_lesions", type="integer", nullable=true)
     */
    private $amountLesions;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Assert\File(maxSize="10M")
     * @Vich\UploadableField(mapping="logo_file", fileNameProperty="logo")
     *
     * @var File
     */
    private $logoFile;

    public function __construct()
    {
        parent::__construct();
        $this->coaches = new ArrayCollection();
        $this->teamGroup = new ArrayCollection();
        $this->players = new ArrayCollection();
    }

    /**
     * Add player.
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return Team
     */
    public function addPlayer(\AppBundle\Entity\Player $player)
    {
        $this->players->add($player);
        $player->addTeam($this);

        return $this;
    }

    /**
     * Remove player.
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePlayer(\AppBundle\Entity\Player $player)
    {
        $player->removeTeam($this);
        return $this->players->removeElement($player);
    }

    /**
     * Get players.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add coach.
     *
     * @param \AppBundle\Entity\Coach $coach
     *
     * @return Team
     */
    public function addCoach(Coach $coach)
    {
        $this->coaches[] = $coach;
        $coach->addTeam($this);
        return $this;
    }

    /**
     * Remove coach.
     *
     * @param \AppBundle\Entity\Coach $coach
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCoach(\AppBundle\Entity\Coach $coach)
    {
        $coach->removeTeam($this);
        return $this->coaches->removeElement($coach);
    }

    /**
     * Get coaches.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoaches()
    {
        return $this->coaches;
    }

    /**
     * Add teamGroup.
     *
     * @param \AppBundle\Entity\Page\TeamGroup $teamGroup
     *
     * @return Team
     */
    public function addTeamGroup(\AppBundle\Entity\Page\TeamGroup $teamGroup)
    {
        $this->teamGroup[] = $teamGroup;

        return $this;
    }

    /**
     * Remove teamGroup.
     *
     * @param \AppBundle\Entity\Page\TeamGroup $teamGroup
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTeamGroup(\AppBundle\Entity\Page\TeamGroup $teamGroup)
    {
        return $this->teamGroup->removeElement($teamGroup);
    }

    /**
     * Get teamGroup.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeamGroup()
    {
        return $this->teamGroup;
    }

    /**
     *
     * @param File|null $imageFile
     * @throws \Exception
     */
    public function setLogoFile(File $imageFile = null)
    {
        $this->logoFile = $imageFile;
        if ($this->logo instanceof UploadedFile) {
            parent::setUpdatedAt(new \DateTime('now'));
        }
    }

    /**
     * @return File|null
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo): void
    {
        $this->logo = $logo;
    }
    /**
     * @param int $amountGames
     */
    public function setAmountGames($amountGames)
    {
        $this->amountGames = $amountGames;
        return $this;
    }

    /**
     * Get amountGames.
     *
     * @return int
     */
    public function getAmountGames()
    {
        return $this->amountGames;
    }
    /**
     * @param int $amountWins
     */
    public function setAmountWins($amountWins)
    {
        $this->amountWins = $amountWins;
        return $this;
    }

    /**
     * Get amountWins.
     *
     * @return int
     */
    public function getAmountWins()
    {
        return $this->amountWins;
    }
    /**
     * @param int $amountDrawn
     */
    public function setAmountDrawn(int $amountDrawn)
    {
        $this->amountDrawn = $amountDrawn;
        return $this;
    }

    /**
     * Get AmountDrawn.
     *
     * @return int
     */
    public function getAmountDrawn()
    {
        return $this->amountDrawn;
    }
    /**
     * @param int $amountLesions
     */
    public function setAmountLesions(int $amountLesions)
    {
        $this->amountLesions = $amountLesions;
        return $this;
    }

    /**
     * Get AmountLesions.
     *
     * @return int
     */
    public function getAmountLesions()
    {
        return $this->amountLesions;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * FutureMatch
 *
 * @ORM\Table(name="online_match")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OnlineMatchRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\OnlineMatchTranslation")
 */
class OnlineMatch extends AbstractPersonalTranslatable implements TranslatableInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="flagFirstTeam", type="string", length=255, nullable=true)
     */
    private $flagFirstTeam;

    /**
     * @var string
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="nameFirst", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $nameFirst;

    /**
     * @var string
     *
     * @ORM\Column(name="flagSecondTeam", type="string", length=255, nullable=true)
     */
    private $flagSecondTeam;

    /**
     * @var string
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="nameSecond", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $nameSecond;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="matchDate", type="datetime")
     */
    private $matchDate;


    /**
     * @var string
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="nameArena", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $nameArena;
    /**
     * @var string
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="scoreFirstTeam", type="integer", length=11)
     * @Gedmo\Translatable
     */
    private $scoreFirstTeam;
    /**
     * @var string
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="scoreSecondTeam", type="integer", length=11)
     * @Gedmo\Translatable
     */
    private $scoreSecondTeam;

    /**
     * @var string
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="duration", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $duration;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\OnlineMatchTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set flagFirstTeam.
     *
     * @param string $flagFirstTeam
     *
     * @return OnlineMatch
     */
    public function setFlagFirstTeam($flagFirstTeam)
    {
        $this->flagFirstTeam = $flagFirstTeam;

        return $this;
    }

    /**
     * Get flagFirstTeam.
     *
     * @return string
     */
    public function getFlagFirstTeam()
    {
        return $this->flagFirstTeam;
    }

    /**
     * Set nameFirst.
     *
     * @param string $nameFirst
     *
     * @return OnlineMatch
     */
    public function setNameFirst($nameFirst)
    {
        $this->nameFirst = $nameFirst;

        return $this;
    }

    /**
     * Get nameFirst.
     *
     * @return string
     */
    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    /**
     * Set flagSecondTeam.
     *
     * @param string $flagSecondTeam
     *
     * @return OnlineMatch
     */
    public function setFlagSecondTeam($flagSecondTeam)
    {
        $this->flagSecondTeam = $flagSecondTeam;

        return $this;
    }

    /**
     * Get flagSecondTeam.
     *
     * @return string
     */
    public function getFlagSecondTeam()
    {
        return $this->flagSecondTeam;
    }

    /**
     * Set nameSecond.
     *
     * @param string $nameSecond
     *
     * @return OnlineMatch
     */
    public function setNameSecond($nameSecond)
    {
        $this->nameSecond = $nameSecond;

        return $this;
    }

    /**
     * Get nameSecond.
     *
     * @return string
     */
    public function getNameSecond()
    {
        return $this->nameSecond;
    }

    /**
     * Set matchDate.
     *
     * @param \DateTime $matchDate
     *
     * @return OnlineMatch
     */
    public function setMatchDate($matchDate)
    {
        $this->matchDate = $matchDate;

        return $this;
    }

    /**
     * Get matchDate.
     *
     * @return \DateTime
     */
    public function getMatchDate()
    {
        return $this->matchDate;
    }


    /**
     * Set nameArena.
     *
     * @param string $nameArena
     *
     * @return OnlineMatch
     */
    public function setNameArena($nameArena)
    {
        $this->nameArena = $nameArena;

        return $this;
    }

    /**
     * Get nameArena.
     *
     * @return string
     */
    public function getNameArena()
    {
        return $this->nameArena;
    }
    /**
     * Set scoreFirstTeam.
     *
     * @param integer $scoreFirstTeam
     *
     * @return OnlineMatch
     */
    public function setScoreFirstTeam($scoreFirstTeam)
    {
        $this->scoreFirstTeam = $scoreFirstTeam;

        return $this;
    }

    /**
     * Get scoreFirstTeam.
     *
     * @return integer
     */
    public function getScoreFirstTeam()
    {
        return $this->scoreFirstTeam;
    }
    /**
     * Set scoreSecondTeam.
     *
     * @param integer $scoreSecondTeam
     *
     * @return OnlineMatch
     */
    public function setScoreSecondTeam($scoreSecondTeam)
    {
        $this->scoreSecondTeam = $scoreSecondTeam;

        return $this;
    }

    /**
     * Get scoreSecondTeam.
     *
     * @return integer
     */
    public function getScoreSecondTeam()
    {
        return $this->scoreSecondTeam;
    }
    /**
     * Set duration.
     *
     * @param string $duration
     *
     * @return OnlineMatch
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration.
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }
    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param string $isActive
     */
    public function setIsActive(string $isActive): void
    {
        $this->isActive = $isActive;
    }
}

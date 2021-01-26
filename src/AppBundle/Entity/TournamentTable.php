<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TournamentTable
 *
 * @ORM\Table(name="tournament_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TournamentTableRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\TournamentTableTranslation")
 */
class TournamentTable extends AbstractPersonalTranslatable implements TranslatableInterface
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @Gedmo\Translatable
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClubForTournamentTable", mappedBy="tournamentTable")
     * @OrderBy({"position" = "ASC"})
     */
    private $clubs;


    /**
     * @var boolean
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\TournamentTableTranslation",
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
     * Set name.
     *
     * @param string $name
     *
     * @return TournamentTable
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->clubs = new ArrayCollection();
    }

    /**
     * Get isActive.
     *
     * @return bool|null
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add club.
     *
     * @param \AppBundle\Entity\ClubForTournamentTable $club
     *
     * @return TournamentTable
     */
    public function addClub(ClubForTournamentTable $club)
    {
        $this->clubs[] = $club;
        $club->setTournamentTable($this);

        return $this;
    }

    /**
     * Remove club.
     *
     * @param \AppBundle\Entity\ClubForTournamentTable $club
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeClub(ClubForTournamentTable $club)
    {
        return $this->clubs->removeElement($club);
    }

    /**
     * Get clubs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubs()
    {
        return $this->clubs;
    }
}

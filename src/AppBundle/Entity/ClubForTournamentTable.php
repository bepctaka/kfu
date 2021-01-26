<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Faker\Provider\DateTime;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Sonata\TranslationBundle\Model\TranslatableInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ClubForTournamentTable
 *
 * @ORM\Table(name="club_for_tournament_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClubForTournamentTableRepository")
 * @Vich\Uploadable
 */
class ClubForTournamentTable extends AbstractPersonalTranslatable implements TranslatableInterface
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
     */
    private $name;

    /**
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private $image;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="image_file", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;


    /**
     * @var string
     *
     * @ORM\Column(name="game", type="string", length=255)
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $game;

    /**
     * @var int
     *
     * @ORM\Column(name="goalDifference", type="integer")
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $goalDifference;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $points;


    /**
     * @var int|null
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TournamentTable", inversedBy="clubs")
     */
    private $tournamentTable;
    /**
     * @var DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        parent::__construct();
        $this->updatedAt = new \DateTime();
    }






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
     * @return string
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param string $game
     */
    public function setGame(string $game): void
    {
        $this->game = $game;
    }

    /**
     * @return int
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * @param int $goalDifference
     */
    public function setGoalDifference(int $goalDifference): void
    {
        $this->goalDifference = $goalDifference;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    /**
     * Set image.
     *
     * @param string $image
     *
     * @return ClubForTournamentTable
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     *
     * @param File|null $imageFile
     * @throws \Exception
     */
    public function setImageFile(File $imageFile = null)
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set tournamentTable.
     *
     * @param \AppBundle\Entity\TournamentTable|null $tournamentTable
     *
     * @return ClubForTournamentTable
     */
    public function setTournamentTable(\AppBundle\Entity\TournamentTable $tournamentTable = null)
    {
        $this->tournamentTable = $tournamentTable;

        return $this;
    }

    /**
     * Get tournamentTable.
     *
     * @return \AppBundle\Entity\TournamentTable|null
     */
    public function getTournamentTable()
    {
        return $this->tournamentTable;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return ChiefOrPartner
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


}

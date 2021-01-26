<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Faker\Provider\DateTime;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * FutureMatch
 *
 * @ORM\Table(name="future_match")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FutureMatchRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\FutureMatchTranslation")
 * @Vich\Uploadable
 */
class FutureMatch extends AbstractPersonalTranslatable implements TranslatableInterface
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/jpg"},
     *     mimeTypesMessage = "Wrong file type (jpg,png,jpeg)"
     * )
     * @Vich\UploadableField(mapping="image_file", fileNameProperty="flagFirstTeam")
     *
     * @var File
     */
    protected $imageFile;

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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/jpg"},
     *     mimeTypesMessage = "Wrong file type (jpg,png,jpeg)"
     * )
     * @Vich\UploadableField(mapping="image_file", fileNameProperty="flagSecondTeam")
     *
     * @var File
     */
    protected $secondImageFile;

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
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
    * @var DateTime
    * @ORM\Column(name="updated_at", type="datetime")
    */
    private $updatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\FutureMatchTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

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
     * Set flagFirstTeam.
     *
     * @param string $flagFirstTeam
     *
     * @return FutureMatch
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
     *
     * @param File|null $flagFirstTeamFile
     * @throws \Exception
     */
    public function setImageFile(File $flagFirstTeamFile = null)
    {
        $this->imageFile = $flagFirstTeamFile;
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
     * Set nameFirst.
     *
     * @param string $nameFirst
     *
     * @return FutureMatch
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
     * @return FutureMatch
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
     *
     * @param File|null $flagSecondTeamFile
     * @throws \Exception
     */
    public function setSecondImageFile(File $flagSecondTeamFile = null)
    {
        $this->secondImageFile = $flagSecondTeamFile;
        if ($this->secondImageFile instanceof UploadedFile) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File|null
     */
    public function getSecondImageFile()
    {
        return $this->secondImageFile;
    }


    /**
     * Set nameSecond.
     *
     * @param string $nameSecond
     *
     * @return FutureMatch
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
     * @return FutureMatch
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
     * @return FutureMatch
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
    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return FutureMatch
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

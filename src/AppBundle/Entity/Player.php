<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Player
 *
 * @ORM\Table(name="players")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\PlayerTranslation")
 * @Vich\Uploadable
 */
class Player extends AbstractPersonalTranslatable implements TranslatableInterface
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
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @Column(name="full_name", type="string", nullable=false)
     * @Gedmo\Translatable
     */
    protected $fullName;

    /**
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    protected $image;
    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/jpg"},
     *     mimeTypesMessage = "Wrong file type (jpg,png,jpeg)"
     * )
     *
     * @Vich\UploadableField(mapping="image_file", fileNameProperty="image")
     *
     * @var File
     */
    protected $imageFile;

    /**
     * @var date
     * @Column(name="birthday", type="date", nullable=false)
     */
    protected $birthday;

    /**
     * @var string
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @Column(name="biography", type="text", nullable=false)
     * @Gedmo\Translatable
     */
    protected $biography;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\PositionPlayer", inversedBy="player")
     */
    private $position;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Page\Team", inversedBy="players")
     */
    private $team;

    /**
     * @var date
     * @Assert\Date
     * @ORM\Column(name="debut", type="date", nullable=false)
     */
    private $debut;

    /**
     * @var integer
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="amount_games", type="integer", nullable=false)
     */
    private $amountGames;

    /**
     * @var integer
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="amount_goals", type="integer", nullable=false)
     */
    private $amountGoals;

    /**
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="date", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\PlayerTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    public function __construct()
    {
        parent::__construct();
        $this->team = new ArrayCollection();
        $this->position = new ArrayCollection();
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
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
     * Set debut.
     *
     * @param \DateTime $debut
     *
     * @return Player
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut.
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set amountGames.
     *
     * @param int $amountGames
     *
     * @return Player
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
     * Set amountGoals.
     *
     * @param int $amountGoals
     *
     * @return Player
     */
    public function setAmountGoals($amountGoals)
    {
        $this->amountGoals = $amountGoals;

        return $this;
    }

    /**
     * Get amountGoals.
     *
     * @return int
     */
    public function getAmountGoals()
    {
        return $this->amountGoals;
    }

    /**
     * Set fullName.
     *
     * @param string $fullName
     *
     * @return Player
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set image.
     *
     * @param string|null $image
     *
     * @return Player
     */
    public function setImage($image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set birthday.
     *
     * @param \DateTime $birthday
     *
     * @return Player
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set biography.
     *
     * @param string $biography
     *
     * @return Player
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography.
     *
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Player
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Player
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

    /**
     * Add position.
     *
     * @param \AppBundle\Entity\PositionPlayer $position
     *
     * @return Player
     */
    public function addPosition(\AppBundle\Entity\PositionPlayer $position)
    {
        $this->position[] = $position;

        return $this;
    }

    /**
     * Remove position.
     *
     * @param \AppBundle\Entity\PositionPlayer $position
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePosition(\AppBundle\Entity\PositionPlayer $position)
    {
        return $this->position->removeElement($position);
    }

    /**
     * Get position.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add team.
     *
     * @param \AppBundle\Entity\Page\Team $team
     *
     * @return Player
     */
    public function addTeam(\AppBundle\Entity\Page\Team $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team.
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTeam(\AppBundle\Entity\Page\Team $team)
    {
        return $this->team->removeElement($team);
    }

    /**
     * Get team.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeam()
    {
        return $this->team;
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
}

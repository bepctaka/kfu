<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Page\Team;
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
 * Coach
 *
 * @ORM\Table(name="coaches")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoachRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\CoachTranslation")
 * @Vich\Uploadable
 */
class Coach extends AbstractPersonalTranslatable implements TranslatableInterface
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
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @Column(name="full_name", type="string", nullable=false)
     */
    protected $fullName;

    /**
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    protected $image;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/jpg"},
     *     mimeTypesMessage = "Wrong file type (jpg,png,jpeg)"
     * )
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\TypeCoach", inversedBy="coach")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Page\Team", inversedBy="coaches")
     */
    private $team;

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
     *     targetEntity="AppBundle\Entity\CoachTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    public function __construct()
    {
        parent::__construct();
        $this->team = new ArrayCollection();
        $this->type = new ArrayCollection();
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
     * Add team.
     *
     * @param \AppBundle\Entity\Page\Team $team
     *
     * @return Coach
     */
    public function addTeam(Team $team)
    {
        $this->team[] = $team;

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
     * Add type.
     *
     * @param \AppBundle\Entity\TypeCoach $type
     *
     * @return Coach
     */
    public function addType(\AppBundle\Entity\TypeCoach $type)
    {
        $this->type[] = $type;

        return $this;
    }

    /**
     * Remove type.
     *
     * @param \AppBundle\Entity\TypeCoach $type
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeType(\AppBundle\Entity\TypeCoach $type)
    {
        return $this->type->removeElement($type);
    }

    /**
     * Get type.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set fullName.
     *
     * @param string $fullName
     *
     * @return Coach
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
     * @return Coach
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
     * @return Coach
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
     * @return Coach
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
     * @return Coach
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
     * @return Coach
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

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
 * ChiefOrPartner
 *
 * @ORM\Table(name="chief_or_partner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChiefOrPartnerRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ChiefOrPartnerTranslation")
 * @Vich\Uploadable
 */
class ChiefOrPartner extends AbstractPersonalTranslatable implements TranslatableInterface
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
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private $image;
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
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $fullName;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=30)
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $description;

    /**
     * @var DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Page\BasePage", inversedBy="chiefOrPartner")
     */
    private $page;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\ChiefOrPartnerTranslation",
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
     * Set image.
     *
     * @param string $image
     *
     * @return ChiefOrPartner
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
     * Set fullName.
     *
     * @param string $fullName
     *
     * @return ChiefOrPartner
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
     * Set type.
     *
     * @param string $type
     *
     * @return ChiefOrPartner
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return ChiefOrPartner
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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

    /**
     * Set page.
     *
     * @param \AppBundle\Entity\Page\BasePage|null $page
     *
     * @return ChiefOrPartner
     */
    public function setPage(\AppBundle\Entity\Page\BasePage $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page.
     *
     * @return \AppBundle\Entity\Page\BasePage|null
     */
    public function getPage()
    {
        return $this->page;
    }
}

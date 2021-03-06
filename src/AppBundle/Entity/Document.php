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
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DocumentRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\DocumentTranslation")
 * @Vich\Uploadable
 */
class Document extends AbstractPersonalTranslatable implements TranslatableInterface
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
     *
     * @Vich\UploadableField(mapping="image_file", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $description;
    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=12)
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     */
    private $type;

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
     * @return Document
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
     * Set title.
     *
     * @param string $title
     *
     * @return Document
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Document
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
     * Set type.
     *
     * @param string $type
     *
     * @return Document
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
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Document
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
     * @return Document
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

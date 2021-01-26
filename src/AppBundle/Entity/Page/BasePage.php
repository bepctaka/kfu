<?php

namespace AppBundle\Entity\Page;

use AppBundle\Entity\ChiefOrPartner;
use AppBundle\Entity\Document;
use AppBundle\Entity\Gallery;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;

/**
 * @ORM\Table(name="base_page")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BasePageRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Page\BasePageTranslation")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="item_type", type="string")
 * @ORM\DiscriminatorMap({
 *     "base_page" = "BasePage",
 *     "page" = "Page",
 *     "news" = "News",
 *     "team" = "Team",
 *     "team_group" = "TeamGroup",
 *     "project" = "Project",
 *     "vacancy" = "Vacancy",
 *     "foot_hall" = "FootHall",
 *     "for_fans" = "ForFans",
 *     "league" = "League",
 *     "tournament" = "Tournament",
 *     "video" = "Video",
 *     "menu" = "Menu"
 *     })
 * @Vich\Uploadable
 */
class BasePage extends AbstractPersonalTranslatable implements TranslatableInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var string
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @Column(name="title", type="string", nullable=false)
     */
    protected $title;

    /**
     * @var string
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @Column(name="subtitle", type="string", nullable=true)
     */
    private $subtitle;

    /**
     * @var string
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;
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
     * @Gedmo\Slug(fields={"title"})
     * @var string
     * @ORM\Column(name="slug", type="string", nullable=false)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Page\BasePage", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Page\BasePage", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Gallery", mappedBy="basePage")
     */
    private $gallery;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ChiefOrPartner", mappedBy="page")
     */
    private $chiefOrPartner;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Document", mappedBy="page")
     */
    private $document;

    /**
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="date", nullable=false)
     */
    private $updatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Page\BasePageTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    public function __construct()
    {
        parent::__construct();
        $this->children = new ArrayCollection();
        $this->gallery = new ArrayCollection();
        $this->chiefOrPartner = new ArrayCollection();
        $this->document = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
            $this->updatedAt = new DateTime('now');
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
     * @return BasePage
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
     * Set subtitle.
     *
     * @param string $subtitle
     *
     * @return BasePage
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle.
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return BasePage
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
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Add child.
     *
     * @param \AppBundle\Entity\Page\BasePage $child
     *
     * @return BasePage
     */
    public function addChild(BasePage $child)
    {
        $this->children[] = $child;
        $child->setParent($this);

        return $this;
    }

    /**
     * Remove child.
     *
     * @param \AppBundle\Entity\Page\BasePage $child
     */
    public function removeChild(BasePage $child)
    {
        $child->setParent(null);
        $this->children->removeElement($child);
    }

    /**
     * Get children.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent.
     *
     * @param \AppBundle\Entity\Page\BasePage|null $parent
     *
     * @return BasePage
     */
    public function setParent(BasePage $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return \AppBundle\Entity\Page\BasePage|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add gallery.
     *
     * @param \AppBundle\Entity\Gallery $gallery
     *
     * @return BasePage
     */
    public function addGallery(Gallery $gallery)
    {
        $this->gallery[] = $gallery;
        $gallery->setBasePage($this);

        return $this;
    }

    /**
     * Remove gallery.
     *
     * @param \AppBundle\Entity\Gallery $gallery
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeGallery(Gallery $gallery)
    {
        $gallery->setBasePage(null);

        return $this->gallery->removeElement($gallery);
    }

    /**
     * Get gallery.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Add chiefOrPartner.
     *
     * @param \AppBundle\Entity\ChiefOrPartner $chiefOrPartner
     *
     * @return BasePage
     */
    public function addChiefOrPartner(ChiefOrPartner $chiefOrPartner)
    {
        $this->chiefOrPartner[] = $chiefOrPartner;
        $chiefOrPartner->setPage($this);

        return $this;
    }

    /**
     * Remove chiefOrPartner.
     *
     * @param \AppBundle\Entity\ChiefOrPartner $chiefOrPartner
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeChiefOrPartner(ChiefOrPartner $chiefOrPartner)
    {
        $chiefOrPartner->setPage(null);
        return $this->chiefOrPartner->removeElement($chiefOrPartner);
    }

    /**
     * Get chiefOrPartner.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChiefOrPartner()
    {
        return $this->chiefOrPartner;
    }
    /**
     * Add document.
     *
     * @param \AppBundle\Entity\Document $document
     *
     * @return BasePage
     */
    public function addDocument(Document $document)
    {
        $this->document[] = $document;
        $document->setPage($this);

        return $this;
    }

    /**
     * Remove document.
     *
     * @param \AppBundle\Entity\Document $document
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDocument(Document $document)
    {
        $document->setPage(null);
        return $this->document->removeElement($document);
    }

    /**
     * Get document.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocument()
    {
        return $this->document;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="images")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Image
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
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="image_file", fileNameProperty="image")
     ** @Assert\File(
     *     maxSize="10M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/jpg"},
     *     mimeTypesMessage = "Wrong file type (jpg,png,jpeg)"
     * )
     *@Assert\Valid()
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Slider", inversedBy="images")
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $slider;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gallery", inversedBy="images")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $gallery;
    /**
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="date", nullable=false)
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * Set slider.
     *
     * @param \AppBundle\Entity\Slider|null $slider
     *
     * @return Image
     */
    public function setSlider(\AppBundle\Entity\Slider $slider = null)
    {
        $this->slider = $slider;

        return $this;
    }

    /**
     * Get slider.
     *
     * @return \AppBundle\Entity\Slider|null
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     *
     * @param File|null $imageFile
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Image
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
     * @return Image
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
     * Set image.
     *
     * @param string|null $image
     *
     * @return Image
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
     * Set gallery.
     *
     * @param \AppBundle\Entity\Gallery|null $gallery
     *
     * @return Image
     */
    public function setGallery(\AppBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery.
     *
     * @return \AppBundle\Entity\Gallery|null
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}

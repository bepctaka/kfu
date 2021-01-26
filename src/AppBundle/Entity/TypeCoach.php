<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypeCoach
 *
 * @ORM\Table(name="type_coach")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeCoachRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\TypeCoachTranslation")
 */
class TypeCoach extends AbstractPersonalTranslatable implements TranslatableInterface
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Gedmo\Translatable
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Coach", mappedBy="type")
     */
    private $coach;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\TypeCoachTranslation",
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
     * @return TypeCoach
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
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->coach = new ArrayCollection();
    }

    /**
     * Add coach.
     *
     * @param \AppBundle\Entity\Coach $coach
     *
     * @return TypeCoach
     */
    public function addCoach(Coach $coach)
    {
        $this->coach[] = $coach;

        return $this;
    }

    /**
     * Remove coach.
     *
     * @param \AppBundle\Entity\Coach $coach
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCoach(Coach $coach)
    {
        return $this->coach->removeElement($coach);
    }

    /**
     * Get coach.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoach()
    {
        return $this->coach;
    }
}

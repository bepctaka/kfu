<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PositionPlayer
 *
 * @ORM\Table(name="position_player")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PositionPlayerRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\PositionPlayerTranslation")
 */
class PositionPlayer extends AbstractPersonalTranslatable implements TranslatableInterface
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Player", mappedBy="position")
     */
    private $player;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\PositionPlayerTranslation",
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
     * @return PositionPlayer
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
        $this->player = new ArrayCollection();
    }

    /**
     * Add player.
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return PositionPlayer
     */
    public function addPlayer(Player $player)
    {
        $this->player[] = $player;

        return $this;
    }

    /**
     * Remove player.
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePlayer(Player $player)
    {
        return $this->player->removeElement($player);
    }

    /**
     * Get player.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayer()
    {
        return $this->player;
    }
}

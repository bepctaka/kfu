<?php

namespace AppBundle\Entity\Page;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Vacancy
 *
 * @ORM\Table(name="vacancy")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VacancyRepository")
 */
class Vacancy extends BasePage
{
    /**
     * @var string
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="experience", type="string", length=255)
     */
    private $experience;

    /**
     * @var string
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="skill", type="string", length=255)
     */
    private $skill;

    /**
     * @var string
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="age", type="string", length=255)
     */
    private $age;

    /**
     * @var string
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="team", type="string", length=255)
     */
    private $team;

    /**
     * @var string
     * @Gedmo\Translatable
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @ORM\Column(name="language", type="string", length=255)
     */
    private $language;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Summary", mappedBy="vacancy",  cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $summary;

    /**
     * Set experience.
     *
     * @param string $experience
     *
     * @return Vacancy
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience.
     *
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set skill.
     *
     * @param string $skill
     *
     * @return Vacancy
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill.
     *
     * @return string
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Vacancy
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
     * Set age.
     *
     * @param string $age
     *
     * @return Vacancy
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age.
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set team.
     *
     * @param string $team
     *
     * @return Vacancy
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team.
     *
     * @return string
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set language.
     *
     * @param string $language
     *
     * @return Vacancy
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Add summary.
     *
     * @param \AppBundle\Entity\Summary $summary
     *
     * @return Vacancy
     */
    public function addSummary(\AppBundle\Entity\Summary $summary)
    {
        $this->summary[] = $summary;

        return $this;
    }

    /**
     * Remove summary.
     *
     * @param \AppBundle\Entity\Summary $summary
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSummary(\AppBundle\Entity\Summary $summary)
    {
        return $this->summary->removeElement($summary);
    }

    /**
     * Get summary.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSummary()
    {
        return $this->summary;
    }
}

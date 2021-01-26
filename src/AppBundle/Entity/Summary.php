<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Summary
 *
 * @ORM\Table(name="summaries")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SummaryRepository")
 */
class Summary
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
     * @Assert\NotBlank(message="Пустые данные")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(message="Пустые данные")
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     * @Assert\NotBlank(message="Пустые данные")
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     * @Assert\NotBlank(message="Пустые данные")
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Пустые данные")
     * @Assert\Email(
     *     message = "Почта не корректна.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=65)
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank(message="Пустые данные")
     * @ORM\Column(name="message", type="text", length=1024)
     */
    private $message;
    /**
     * @var string
     * @Assert\NotBlank(message="Пустые данные")
     * @ORM\Column(name="experience", type="text", length=1024)
     */
    private $experience;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Page\Vacancy", inversedBy="summary")
     * @ORM\JoinColumn(name="vacancy_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $vacancy;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * Set name.
     *
     * @param string $name
     *
     * @return Summary
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
     * Set surname.
     *
     * @param string $surname
     *
     * @return Summary
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname.
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return Summary
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Summary
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Summary
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return Summary
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set vacancy.
     *
     * @param \AppBundle\Entity\Page\Vacancy|null $vacancy
     *
     * @return Summary
     */
    public function setVacancy(\AppBundle\Entity\Page\Vacancy $vacancy = null)
    {
        $this->vacancy = $vacancy;

        return $this;
    }

    /**
     * Get vacancy.
     *
     * @return \AppBundle\Entity\Page\Vacancy|null
     */
    public function getVacancy()
    {
        return $this->vacancy;
    }

    /**
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param string $experience
     */
    public function setExperience(string $experience)
    {
        $this->experience = $experience;
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
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}

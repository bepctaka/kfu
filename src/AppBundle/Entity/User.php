<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity("email", message="Такой email уже зарегестрирован в системе")
 */
class User implements UserInterface
{
    public const NAMES_ROLES = [
        'ROLE_ADMIN' => 'Администратор',
        'ROLE_USER' => 'Пользователь',
    ];
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=65)
     *
     * @Assert\NotBlank(message="Поле не может быть пустым", groups={"createUser", "editUser"})
     * @Assert\Email(
     *     message = "Данная электронная почта  '{{ value }}' не корректна.",
     *     checkMX = true,
     *     groups={"createUser", "editUser"}
     * )
     */
    private $email;

    /**
     * @ORM\Column(name="username", type="string", length=65)
     *
     * @Assert\NotBlank(message="Поле не может быть пустым", groups={"createUser", "editUser"})
     */
    private $username;

    /**
     * @ORM\Column(name="roles", type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(name="password", type="string", nullable=true)
     */
    private $password;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @Assert\NotBlank(message="Поле не может быть пустым", groups={"createUser"})
     * @Assert\Length(
     *      min = 8,
     *      minMessage = "Пароль должен быть не меньше {{ limit }}  символов",
     *     groups={"createUser", "editUser"}
     * )
     */
    private $plainPassword;


    public function __construct()
    {
        $this->active = true;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getRolesAsString()
    {
        if (!empty($this->getRoles())) {

            return implode(",", array_flip(array_intersect(array_flip(self::NAMES_ROLES), $this->getRoles())));
        }
        return '';
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
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
     * Set username.
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set roles.
     *
     */
    public function getRoles()
    {
        if (is_array($this->roles)) {
            return null;
        }
        return json_decode($this->roles);
    }

    /**
     * Get roles.
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles)
    {
        $this->roles = json_encode($roles);
        return $this;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getLocale()
    {
        return 'ru';
    }
}

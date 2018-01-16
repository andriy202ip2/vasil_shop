<?php

namespace Security\UserBundle\Entity;
use Doctrine\Common\Collections;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BaseUser
 *
 * @ORM\Table(name="name_email")
 * @ORM\MappedSuperclass
 */
abstract class BaseUser implements AdvancedUserInterface, \Serializable
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
     *
     * @ORM\Column(name="username", type="string", length=32, unique=true)
     *
     * @Assert\NotBlank(message="username can't be blank .")
     */
    private $username;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     *
     * @Assert\NotBlank(message="password can't be blank .")
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, unique=true)
     *
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank(message="name can't be blank .")
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(name="surname", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="surname can't be blank .")
     */
    private $surname;
    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", nullable=false, length=255,
     *     columnDefinition="ENUM('ROLE_USER', 'ROLE_TEAM', 'ROLE_OPERATOR', 'ROLE_ADMIN', 'ROLE_ROOT')",
     *     options={"default" = "ROLE_USER"})
     *
     * @Assert\NotBlank(message="roles can't be blank .")
     */
    private $roles;
    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        //if (!is_null($password)) {
            //$this->password = $password;
        //}
        
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set roles
     *
     * @param string $roles
     * @return User
     */
    public function setRole($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return array($this->roles);
    }
    public function setRoles($roles){
        $this->roles = $roles;
    }
    public function getRole()
    {
        return $this->roles;
    }
    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function eraseCredentials() {

    }

    public function getSalt() {

    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    public function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }
    public function isEnabled()
    {
        return $this->isActive;
    }



    /**
     * Set name
     *
     * @param string $name
     * @return BaseUser
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return BaseUser
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return BaseUser
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
    
}

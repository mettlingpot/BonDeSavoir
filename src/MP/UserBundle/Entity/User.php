<?php

namespace MP\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use MP\CompBundle\Entity\Comp;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="MP\UserBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;
    
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;


    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt = '';

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = ['ROLE_AUTEUR'];

    /**
     * @var int
     *
     * @ORM\Column(name="bon", type="integer")
     */
    private $bon;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;
    
    /**
    * @ORM\ManyToMany(targetEntity="MP\CompBundle\Entity\Comp", cascade={"persist"})
    */
    private $comps;
    
    /**
    * @ORM\OneToOne(targetEntity="MP\UserBundle\Entity\Adresse", cascade={"persist"})
    */
    private $adresse;
      
    public function __construct()
      {
        $this->comps = new ArrayCollection();
        $this->bon = 5;
        $this->adresse = new Adresse();
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
     * Set username
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
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set bon
     *
     * @param integer $bon
     *
     * @return User
     */
    public function setBon($bon)
    {
        $this->bon = $bon;

        return $this;
    }

    /**
     * Get bon
     *
     * @return int
     */
    public function getBon()
    {
        return $this->bon;
    }
        
    /**
     * Set bon
     *
     * @param integer $bon
     *
     * @return User
     */
    public function addBon($bon)
    {
        $this->bon += $bon;

        return $this;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
        
    public function eraseCredentials()
    {
        
    }

    /**
     * Add comp
     *
     * @param \MP\CompBundle\Entity\Comp $comp
     *
     * @return User
     */
    public function addComp(\MP\CompBundle\Entity\Comp $comp)
    {
        $this->comps[] = $comp;

        return $this;
    }

    /**
     * Remove comp
     *
     * @param \MP\CompBundle\Entity\Comp $comp
     */
    public function removeComp(\MP\CompBundle\Entity\Comp $comp)
    {
        $this->comps->removeElement($comp);
    }

    /**
     * Get comps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComps()
    {
        return $this->comps;
    }

    /**
     * Add compSouhait
     *
     * @param \MP\CompBundle\Entity\Comp $compSouhait
     *
     * @return User
     */
    public function addCompSouhait(\MP\CompBundle\Entity\Comp $compSouhait)
    {
        $this->compSouhait[] = $compSouhait;

        return $this;
    }

    /**
     * Remove compSouhait
     *
     * @param \MP\CompBundle\Entity\Comp $compSouhait
     */
    public function removeCompSouhait(\MP\CompBundle\Entity\Comp $compSouhait)
    {
        $this->compSouhait->removeElement($compSouhait);
    }

    /**
     * Get compSouhait
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompSouhait()
    {
        return $this->compSouhait;
    }

    /**
     * Set adresse
     *
     * @param \MP\UserBundle\Entity\Adresse $adresse
     *
     * @return User
     */
    public function setAdresse(\MP\UserBundle\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \MP\UserBundle\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}

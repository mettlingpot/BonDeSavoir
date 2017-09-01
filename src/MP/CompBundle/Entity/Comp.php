<?php

namespace MP\CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use MP\UserBundle\Entity\User;

/**
 * Comp
 *
 * @ORM\Table(name="comp")
 * @ORM\Entity(repositoryClass="MP\CompBundle\Repository\CompRepository")
 */
class Comp
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="bon", type="integer")
     */
    private $bon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temps", type="time")
     */
    private $temps;    
    
    /**
    * @ORM\ManyToMany(targetEntity="MP\UserBundle\Entity\User", cascade={"persist"})
    */
    private $userSouhait;
      
    public function __construct()
      {
        $this->userSouhait = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Comp
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
     * Set bon
     *
     * @param integer $bon
     *
     * @return Comp
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
     * Set temps
     *
     * @param \DateTime $temps
     *
     * @return Comp
     */
    public function setTemps($temps)
    {
        $this->temps = $temps;

        return $this;
    }

    /**
     * Get temps
     *
     * @return \DateTime
     */
    public function getTemps()
    {
        return $this->temps;
    }

    /**
     * Add userSouhait
     *
     * @param \MP\UserBundle\Entity\User $userSouhait
     *
     * @return Comp
     */
    public function addUserSouhait(\MP\UserBundle\Entity\User $userSouhait)
    {
        $this->userSouhait[] = $userSouhait;

        return $this;
    }

    /**
     * Remove userSouhait
     *
     * @param \MP\UserBundle\Entity\User $userSouhait
     */
    public function removeUserSouhait(\MP\UserBundle\Entity\User $userSouhait)
    {
        $this->userSouhait->removeElement($userSouhait);
    }

    /**
     * Get userSouhait
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserSouhait()
    {
        return $this->userSouhait;
    }
}

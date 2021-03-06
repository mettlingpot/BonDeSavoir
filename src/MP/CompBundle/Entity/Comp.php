<?php

namespace MP\CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use MP\UserBundle\Entity\User;
use MP\CompBundle\Entity\Niveau;
use MP\CompBundle\Entity\Category;
use MP\CompBundle\Entity\Materiel;

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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255,)
     */
    private $description;

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
    /**
    * @ORM\ManyToMany(targetEntity="MP\CompBundle\Entity\Niveau", cascade={"persist"})
    */
    private $niveau;    
    
    /**
    * @ORM\ManyToMany(targetEntity="MP\CompBundle\Entity\Category", cascade={"persist"})
    */
    private $categories;
        
    /**
    * @ORM\ManyToOne(targetEntity="MP\CompBundle\Entity\Materiel", cascade={"persist"})
    */
    private $matos;
      
    public function __construct()
      {
        $this->userSouhait = new ArrayCollection();
        $this->niveau = new ArrayCollection();
        $this->categories = new ArrayCollection();
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

    /**
     * Set niveau
     *
     * @param \MP\CompBundle\Entity\Niveau $niveau
     *
     * @return Comp
     */
    public function setNiveau(\MP\CompBundle\Entity\Niveau $niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \MP\CompBundle\Entity\Niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Add niveau
     *
     * @param \MP\CompBundle\Entity\Niveau $niveau
     *
     * @return Comp
     */
    public function addNiveau(\MP\CompBundle\Entity\Niveau $niveau)
    {
        $this->niveau[] = $niveau;

        return $this;
    }

    /**
     * Remove niveau
     *
     * @param \MP\CompBundle\Entity\Niveau $niveau
     */
    public function removeNiveau(\MP\CompBundle\Entity\Niveau $niveau)
    {
        $this->niveau->removeElement($niveau);
    }

    /**
     * Add category
     *
     * @param \MP\CompBundle\Entity\Category $category
     *
     * @return Comp
     */
    public function addCategory(\MP\CompBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \MP\CompBundle\Entity\Category $category
     */
    public function removeCategory(\MP\CompBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Comp
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add mato
     *
     * @param \MP\CompBundle\Entity\Materiel $mato
     *
     * @return Comp
     */
    public function addMato(\MP\CompBundle\Entity\Materiel $mato)
    {
        $this->matos[] = $mato;

        return $this;
    }

    /**
     * Remove mato
     *
     * @param \MP\CompBundle\Entity\Materiel $mato
     */
    public function removeMato(\MP\CompBundle\Entity\Materiel $mato)
    {
        $this->matos->removeElement($mato);
    }

    /**
     * Get matos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatos()
    {
        return $this->matos;
    }

    /**
     * Set matos
     *
     * @param \MP\CompBundle\Entity\Materiel $matos
     *
     * @return Comp
     */
    public function setMatos(\MP\CompBundle\Entity\Materiel $matos = null)
    {
        $this->matos = $matos;

        return $this;
    }
}

<?php

namespace MP\CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use MP\UserBundle\Entity\User;
use MP\UserBundle\Entity\Adresse;
use MP\CompBundle\Entity\Comp;

/**
 * Session
 *
 * @ORM\Table(name="session")
 * @ORM\Entity(repositoryClass="MP\CompBundle\Repository\SessionRepository")
 */
class Session
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="NbrUserMax", type="integer")
     */
    private $nbrUserMax;
        
    /**
    * @ORM\OneToOne(targetEntity="MP\UserBundle\Entity\Adresse", cascade={"persist"})
    */
    private $adresse;
        
    /**
    * @ORM\ManyToOne(targetEntity="MP\UserBundle\Entity\User", cascade={"persist"})
    */
    private $dealer;
        
    /**
    * @ORM\ManyToMany(targetEntity="MP\UserBundle\Entity\User", cascade={"persist"})
    */
    private $lerners;
        
    /**
    * @ORM\ManyToOne(targetEntity="MP\CompBundle\Entity\Comp", cascade={"persist"})
    */
    private $competence;
      
    public function __construct()
      {
        //$this->comps = new ArrayCollection();
        $this->adresse = new Adresse();
        $this->competence = new ArrayCollection();
        $this->lerners = new ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Session
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nbrUserMax
     *
     * @param integer $nbrUserMax
     *
     * @return Session
     */
    public function setNbrUserMax($nbrUserMax)
    {
        $this->nbrUserMax = $nbrUserMax;

        return $this;
    }

    /**
     * Get nbrUserMax
     *
     * @return int
     */
    public function getNbrUserMax()
    {
        return $this->nbrUserMax;
    }

    /**
     * Set adresse
     *
     * @param \MP\UserBundle\Entity\Adresse $adresse
     *
     * @return Session
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

    /**
     * Set dealer
     *
     * @param \MP\UserBundle\Entity\User $dealer
     *
     * @return Session
     */
    public function setDealer(\MP\UserBundle\Entity\User $dealer)
    {
        $this->dealer = $dealer;

        return $this;
    }

    /**
     * Get dealer
     *
     * @return \MP\UserBundle\Entity\User
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * Add lerner
     *
     * @param \MP\UserBundle\Entity\User $lerner
     *
     * @return Session
     */
    public function addLerner(\MP\UserBundle\Entity\User $lerner)
    {
        $this->lerners[] = $lerner;

        return $this;
    }

    /**
     * Remove lerner
     *
     * @param \MP\UserBundle\Entity\User $lerner
     */
    public function removeLerner(\MP\UserBundle\Entity\User $lerner)
    {
        $this->lerners->removeElement($lerner);
    }

    /**
     * Get lerners
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLerners()
    {
        return $this->lerners;
    }

    /**
     * Set competence
     *
     * @param \MP\CompBundle\Entity\Comp $competence
     *
     * @return Session
     */
    public function setCompetence(\MP\CompBundle\Entity\Comp $competence )
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return \MP\CompBundle\Entity\Comp
     */
    public function getCompetence()
    {
        return $this->competence;
    }
}

<?php

namespace MP\CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use MP\UserBundle\Entity\User;
use MP\CompBundle\Entity\Comp;

/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="MP\CompBundle\Repository\DemandeRepository")
 */
class Demande
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
     * @ORM\Column(name="date", type="date")
     */
    private $dateDemande;
        
    /**
    * @ORM\ManyToOne(targetEntity="MP\UserBundle\Entity\User", cascade={"persist"})
    */
    private $target;
           
    /**
    * @ORM\ManyToMany(targetEntity="MP\UserBundle\Entity\User", cascade={"persist"})
    */
    private $requester;
        
    /**
    * @ORM\ManyToMany(targetEntity="MP\CompBundle\Entity\Comp", cascade={"persist"})
    */
    private $competence;
        
    public function __construct()
      {
        $this->requester = new ArrayCollection();
        $this->competence = new ArrayCollection();
        $this->dateDemande = new \Datetime();
        
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
     * @return Demande
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
     * Set target
     *
     * @param \MP\UserBundle\Entity\User $target
     *
     * @return Demande
     */
    public function setTarget(\MP\UserBundle\Entity\User $target )
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \MP\UserBundle\Entity\User
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set requester
     *
     * @param \MP\UserBundle\Entity\User $requester
     *
     * @return Demande
     */
    public function setRequester(\MP\UserBundle\Entity\User $requester )
    {
        $this->requester = $requester;

        return $this;
    }

    /**
     * Get requester
     *
     * @return \MP\UserBundle\Entity\User
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * Set competence
     *
     * @param \MP\CompBundle\Entity\Comp $competence
     *
     * @return Demande
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

    /**
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     *
     * @return Demande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Add target
     *
     * @param \MP\UserBundle\Entity\User $target
     *
     * @return Demande
     */
    public function addTarget(\MP\UserBundle\Entity\User $target)
    {
        $this->target[] = $target;

        return $this;
    }

    /**
     * Remove target
     *
     * @param \MP\UserBundle\Entity\User $target
     */
    public function removeTarget(\MP\UserBundle\Entity\User $target)
    {
        $this->target->removeElement($target);
    }

    /**
     * Add requester
     *
     * @param \MP\UserBundle\Entity\User $requester
     *
     * @return Demande
     */
    public function addRequester(\MP\UserBundle\Entity\User $requester)
    {
        $this->requester[] = $requester;

        return $this;
    }

    /**
     * Remove requester
     *
     * @param \MP\UserBundle\Entity\User $requester
     */
    public function removeRequester(\MP\UserBundle\Entity\User $requester)
    {
        $this->requester->removeElement($requester);
    }

    /**
     * Add competence
     *
     * @param \MP\CompBundle\Entity\Comp $competence
     *
     * @return Demande
     */
    public function addCompetence(\MP\CompBundle\Entity\Comp $competence)
    {
        $this->competence[] = $competence;

        return $this;
    }

    /**
     * Remove competence
     *
     * @param \MP\CompBundle\Entity\Comp $competence
     */
    public function removeCompetence(\MP\CompBundle\Entity\Comp $competence)
    {
        $this->competence->removeElement($competence);
    }
}

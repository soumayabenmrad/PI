<?php

namespace FixBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agenda
 *
 * @ORM\Table(name="agenda")
 * @ORM\Entity(repositoryClass="FixBundle\Repository\AgendaRepository")
 */
class Agenda
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
     * @ORM\Column(name="disponibilite", type="boolean")
     */
    private $disponibilite;


    /**
     * @ORM\OneToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="profid",referencedColumnName="id")
     */

    private $profid;

    /**
     * @return mixed
     */
    public function getProfid()
    {
        return $this->profid;
    }

    /**
     * @param mixed $profid
     */
    public function setProfid($profid)
    {
        $this->profid = $profid;
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
     * Set disponibilite
     *
     * @param boolean $disponibilite
     *
     * @return Agenda
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * Get disponibilite
     *
     * @return boolean
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }
}


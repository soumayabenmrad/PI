<?php

namespace FixBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evennement
 *
 * @ORM\Table(name="evennement")
 * @ORM\Entity(repositoryClass="FixBundle\Repository\EvennementRepository")
 */
class Evennement
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="nbrPlace", type="string", length=255)
     */
    private $nbrPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="PS", type="string", length=255)
     */
    private $pS;

    /**
     * @var string
     *
     * @ORM\Column(name="heur", type="string", length=255)
     */
    private $heur;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Evennement
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Evennement
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
     * Set date
     *
     * @param string $date
     *
     * @return Evennement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nbrPlace
     *
     * @param string $nbrPlace
     *
     * @return Evennement
     */
    public function setNbrPlace($nbrPlace)
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    /**
     * Get nbrPlace
     *
     * @return string
     */
    public function getNbrPlace()
    {
        return $this->nbrPlace;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Evennement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set pS
     *
     * @param string $pS
     *
     * @return Evennement
     */
    public function setPS($pS)
    {
        $this->pS = $pS;

        return $this;
    }

    /**
     * Get pS
     *
     * @return string
     */
    public function getPS()
    {
        return $this->pS;
    }

    /**
     * Set heur
     *
     * @param string $heur
     *
     * @return Evennement
     */
    public function setHeur($heur)
    {
        $this->heur = $heur;

        return $this;
    }

    /**
     * Get heur
     *
     * @return string
     */
    public function getHeur()
    {
        return $this->heur;
    }
}


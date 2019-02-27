<?php

namespace FixBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUSer ;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="FixBundle\Repository\UtilisateurRepository")
 */
class Utilisateur extends BaseUSer
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    protected $prenom;
    /**
     * @var string
     *
     * @Assert\Type("numeric")
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    protected $telephone;
    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255,nullable=true)
     */
    protected $sexe;
    /**
     * @var string
     *
     * @ORM\Column(name="dateNaissance", type="date", length=255, nullable=true)
     */
    protected $dateNaissance;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    protected $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="code_postale", type="integer", length=255)
     */

    protected $codePostale;
    /**
     * @var string
     *
     * @ORM\Column(name="etat_civile", type="string", length=255)
     */
    protected $etatCivile;
    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="string", length=255, nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="string", length=255 , nullable=true)
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="string", length=255 , nullable=true)
     */
    private $rating;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Categorie",inversedBy="professionels")
     * @ORM\JoinColumn(name="categorie_id",referencedColumnName="id")
     */

    protected $categorie;

    /**
     * @return int
     */

    /**
     *
     * @ORM\ManyToOne(targetEntity="Souscategorie")
     * @ORM\JoinColumn(name="souscategorie_id",referencedColumnName="id")
     */
    private $souscategorie;

    /**
     * @return mixed
     */
    public function getSouscategorie()
    {
        return $this->souscategorie;
    }

    /**
     * @param mixed $souscategorie
     */
    public function setSouscategorie($souscategorie)
    {
        $this->souscategorie = $souscategorie;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getCodePostale()
    {
        return $this->codePostale;
    }

    /**
     * @param mixed $codePostale
     */
    public function setCodePostale($codePostale)
    {
        $this->codePostale = $codePostale;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getEtatCivile()
    {
        return $this->etatCivile;
    }

    /**
     * @param mixed $etatCivile
     */
    public function setEtatCivile($etatCivile)
    {
        $this->etatCivile = $etatCivile;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
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
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }




}


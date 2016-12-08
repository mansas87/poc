<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="offre_emploi")
 */
class OffreEmploi
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	/**
     * @Assert\NotBlank(message = "offreEmploi.intitule.not_blank")
     * @ORM\Column(type="string")
     */
	protected $intitule;
	/**
     * @ORM\Column(type="string")
     */
	protected $descriptif;
	/**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     * @ORM\Column(type="datetime")
     */
	protected $dateDebut;
	/**
     * @ORM\Column(type="integer")
     */
	protected $duree;
	/**
     * @ORM\Column(type="string")
     */
	protected $contrat;


	public function getContrat(){
		return $this->contrat;
	}

	public function setContrat($contrat){
		$this->contrat = $contrat;
	}

	public function getIntitule(){
		return $this->intitule;
	}

	public function setIntitule($intitule){
		$this->intitule = $intitule;
	}

	public function getDescriptif(){
		return $this->descriptif;
	}

	public function setDescriptif($descriptif){
		$this->descriptif = $descriptif;
	}
	public function getDateDebut(){
		return $this->dateDebut;
	}

	public function setDateDebut(\DateTime $dateDebut = null){
		$this->dateDebut = $dateDebut;
	}

	public function getDuree(){
		return $this->duree;
	}

	public function setDuree($duree){
		$this->duree = $duree;
	}



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 *
 * @ORM\Table(name="doctors")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DoctorRepository")
 */
class Doctor
{
	/**
	 * @var integer $id
	 *
	 * @ORM\Column(name="id", type="bigint")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 **/
	private $id;

	/**
	 * @var string $author
	 *
	 * @ORM\Column(name="name", type="string", length=100, nullable=false)
	 */
	private $name;

	/**
	 * @var string $author
	 *
	 * @ORM\Column(name="speciality", type="string", length=100, nullable=false)
	 */
	private $specialty;

	/**
	 * @ORM\ManyToOne(targetEntity="Hospital", inversedBy="doctors")
	 * @ORM\JoinColumn(name="hospital_id", referencedColumnName="id")
	 */
	private $hospital;

	/**
	 * @ORM\OneToMany(targetEntity="Patient", mappedBy="doctor")
	 */
	private $patients;

	public function __construct()
	{
		$this->patients = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Patient
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return Patient
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return Hospital
	 */
	public function getHospital()
	{
		return $this->hospital;
	}

	/**
	 * @param Hospital $hospital
	 * @return Patient
	 */
	public function setHospital(Hospital $hospital)
	{
		$this->hospital = $hospital;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getSpecialty()
	{
		return $this->specialty;
	}

	/**
	 * @param \DateTime $specialty
	 */
	public function setSpecialty($specialty)
	{
		$this->specialty = $specialty;
	}

	/**
	 * @return mixed
	 */
	public function getPatients()
	{
		return $this->patients;
	}

	/**
	 * @param mixed $patients
	 */
	public function setPatients(array $patients)
	{
		$this->patients = $patients;
	}


}
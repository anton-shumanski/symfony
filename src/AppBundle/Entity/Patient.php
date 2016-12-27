<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="patients")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PatientRepository")
 */
class Patient
{
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;
	const GENDER_OTHER = 3;

	/**
	 * @var integer $id
	 *
	 * @ORM\Column(name="id", type="bigint")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @var string $author
	 * @ORM\Column(name="name", type="string", length=100, nullable=false)
	 */
	private $name;

	/**
	 * @var string $author
	 *
	 * @ORM\Column(name="dob", type="datetime", length=100, nullable=false)
	 */
	private $dob;

	/**
	 * @var string $author
	 *
	 * @ORM\Column(name="gender", type="string", length=100, nullable=false)
	 */
	private $gender;

	/**
	 * @ORM\ManyToOne(targetEntity="Hospital", inversedBy="patients")
	 * @ORM\JoinColumn(name="hospital_id", referencedColumnName="id")
	 */
	private $hospital;


	/**
	 * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="patients")
	 * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id")
	 */
	private $doctor;

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
	 * @return \DateTime
	 */
	public function getDob()
	{
		return $this->dob;
	}

	/**
	 * @param \DateTime $dob
	 * @return Patient
	 */
	public function setDob($dob)
	{
		$this->dob = $dob;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @param string $gender
	 * @return Patient
	 */
	public function setGender($gender)
	{
		$this->gender = $gender;
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
	 * @return mixed
	 */
	public function getDoctor()
	{
		return $this->doctor;
	}

	/**
	 * @param mixed $doctor
	 */
	public function setDoctor(Doctor $doctor)
	{
		$this->doctor = $doctor;
	}


}
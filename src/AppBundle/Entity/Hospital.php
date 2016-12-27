<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="hospitals")
 * @ORM\Entity
 */
class Hospital
{
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
	 * @ORM\OneToMany(targetEntity="Doctor", mappedBy="hospital")
	 */
	private $doctors;

	/**
	 * @ORM\OneToMany(targetEntity="Patient", mappedBy="hospital")
	 */
	private $patients;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 * @return Hospital
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 * @return Hospital
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
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
	public function setPatients($patients)
	{
		$this->patients = $patients;
	}

	/**
	 * @return mixed
	 */
	public function getDoctors()
	{
		return $this->doctors;
	}

	/**
	 * @param mixed $doctors
	 */
	public function setDoctors($doctors)
	{
		$this->doctors = $doctors;
	}

}
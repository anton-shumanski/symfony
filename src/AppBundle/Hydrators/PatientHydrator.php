<?php

namespace AppBundle\Hydrators;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Hospital;
use AppBundle\Entity\Patient;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class PatientHydrator
{
    /**
     * @var Request
     */
    private $data;
    /**
     * @var Patient
     */
    private $entity;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * PatientHydrator constructor.
     * @param array $data
     * @param Patient $entity
     * @param $entityManager
     */
    public function __construct(array $data, Patient $entity, EntityManager $entityManager)
    {
        $this->data = $data;
        $this->entity = $entity;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Patient
     */
    public function hydrate()
    {
        $this->data['doctor'] = $this->entityManager->getRepository(Doctor::class)->findOneById($this->data['doctor_id']);
        $this->data['hospital'] = $this->entityManager->getRepository(Hospital::class)->findOneById($this->data['hospital_id']);
        $this->data['dob'] = new DateTime($this->data['dob']);

        $this->entity->setName($this->data['name']);
        $this->entity->setDob($this->data['dob']);
        $this->entity->setGender($this->data['gender']);
        $this->entity->setDoctor($this->data['doctor']);
        $this->entity->setHospital($this->data['hospital']);

        return $this->entity;
    }
}
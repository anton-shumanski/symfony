<?php

namespace AppBundle\Services;

use AppBundle\Entity\Patient;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class SavePatientService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Patient
     */
    private $entity;

    /**
     * SavePatientService constructor.
     * @param EntityManager $entityManager
     * @param Patient $entity
     */
    public function __construct(EntityManager $entityManager, Patient $entity)
    {
        $this->entityManager = $entityManager;
        $this->entity = $entity;
    }

    /**
     * @return Patient
     */
    public function execute()
    {
        $this->entityManager->persist($this->entity);
        $this->entityManager->flush();
        return $this->entity;
    }
}
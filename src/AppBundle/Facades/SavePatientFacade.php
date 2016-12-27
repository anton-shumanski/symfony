<?php

namespace AppBundle\Facades;

use AppBundle\Entity\Patient;
use AppBundle\Hydrators\PatientHydrator;
use AppBundle\Services\SavePatientService;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class SavePatientFacade
{
    /**
     * @param array $data
     * @param $entityManager
     * @return Patient
     */
    public static function execute(array $data, $entityManager)
    {
        return (new SavePatientService(
            $entityManager,
            (new PatientHydrator($data, new Patient(), $entityManager))->hydrate()
        ))->execute();
    }
}
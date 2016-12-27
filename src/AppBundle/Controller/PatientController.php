<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Patient;
use AppBundle\Facades\SavePatientFacade;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    /**
     * @Route("/patient/add", )
     * @Method({"POST"})
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function AddAction(Request $request)
    {
        /**
         * @todo validate request data before save it!
         */

        /**
         * @var EntityManager $em
         */
        $em = $this->getDoctrine()->getManager();
        SavePatientFacade::execute(
            $request->query->all(),
            $em
        );

        $doctor = $em->getRepository(Doctor::class)
            ->selectById($request->query->get('doctor_id'));

        $patients = $em->getRepository(Patient::class)
            ->selectByDoctorId($request->query->get('doctor_id'));

        return new JsonResponse([
            'patients' => $patients,
            'doctor' => $doctor,
            'msg' => 'All patients by doctor'
        ]);


    }
}

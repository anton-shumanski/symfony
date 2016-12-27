<?php

use Symfony\Component\HttpFoundation\Request;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
$request = Request::createFromGlobals();

function getHospitalPatients() {
	/**
	 * I really hope that this 'global' statement is not part of your platform :P
	 */
	global $request;

	/**
	 * this param should be passed like param
	 */
	$hospitalId = $request->get('hospitalId');

	// Let's check to see if we have received the hospital id
	if (empty($hospitalId)) {

		return new \Symfony\Component\HttpFoundation\JsonResponse(array(
			'msg' => 'No hospital information received'
		));
	}

	$hospitalRepository = new \AppBundle\Repository\HospitalRepository();
	$patientRepository = new \AppBundle\Repository\PatientRepository();

	$hospital = $hospitalRepository->selectById($hospitalId);
	$patients = $patientRepository->selectByHospital($hospital);

	// Return a list of patients along with the original hospital and a message showing success
	return new \Symfony\Component\HttpFoundation\JsonResponse(array( /** I prefer to use new syntax of arrray [] */
		'patients' => $patients,
		'hospital' => $hospital,
		'msg' => 'Here are the patients for '.$hospital->getName()
	));
}
return getHospitalPatients();

/**
 * How it should looks like this code:
 *
 * 1. The method getHospitalPatients should return array
 * 2. The separate method should convert the result of 'getHospitalPatients' to json
 * 3. If there is no data found we should throw exception or return empty array
 * 4. The 'hospitalId' should be passed like param
 * 5. To be more testable we should add the classes which we use inside the code like DI
 * 6. And of course we should just forget about something like that 'global $request'
 */
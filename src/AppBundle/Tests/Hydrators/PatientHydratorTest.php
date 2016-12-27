<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Hospital;
use AppBundle\Entity\Patient;
use AppBundle\Hydrators\PatientHydrator;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PatientHydratorTest extends WebTestCase
{
    public function testHydrate()
    {
        $data = [
            'name' => 'Anton',
            'dob' => '2016-01-01',
            'doctor_id' => 1,
            'hospital_id' => 1,
            'gender' => 1
        ];

        $entityManagerMock = $this->getEntityManagerMock();
        $patient = (new PatientHydrator($data, new Patient(), $entityManagerMock))->hydrate();

        $this->assertEquals($data['name'], $patient->getName());
        $this->assertInstanceOf(\DateTime::class, $patient->getDob());
        $this->assertInstanceOf(Doctor::class, $patient->getDoctor());
        $this->assertInstanceOf(Hospital::class, $patient->getHospital());
        $this->assertEquals($data['gender'], $patient->getGender());
    }

    /**
     * @param $returnValue
     * @return \PHPUnit_Framework_MockObject_Builder_InvocationMocker
     */
    private function getRepositoryMock($returnValue)
    {
        $repository = $this
            ->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();
        $repository
            ->expects($this->once())
            ->method('findOneById')
            ->will($this->returnValue($returnValue));
        return $repository;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getEntityManagerMock()
    {
        $entityManager = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->setMethods(['getRepository'])
            ->disableOriginalConstructor()
            ->getMock();

        $entityManager
            ->expects($this->any())
            ->method('getRepository')
            ->will($this->returnCallback(
                function($entityName) {
                      return $this->getRepositoryMock(new $entityName);
                }
            ));
        return $entityManager;
    }
}

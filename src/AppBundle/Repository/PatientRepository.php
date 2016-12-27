<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Patient;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class PatientRepository extends EntityRepository implements RepositoryInterface
{
	/** @return Patient */
	public function selectById($id)
	{
		// TODO: Implement selectById() method.
	}

	/** @return Patient[] */
	public function selectByDoctorId($id)
	{
		return $this->getEntityManager()
				->createQueryBuilder('e')
				->select('e')
				->from(Patient::class, 'e')
				->where('e.doctor = :identifier')
				->setParameter('identifier', $id)
				->getQuery()
				->getResult(Query::HYDRATE_ARRAY);
	}

	/**
	 * @param \AppBundle\Entity\Hospital $hospital
	 * @return Patient[]
	 */
	public function selectByHospital($hospital){}
}
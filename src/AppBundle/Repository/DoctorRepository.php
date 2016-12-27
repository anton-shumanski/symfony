<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Doctor;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class DoctorRepository extends EntityRepository implements RepositoryInterface
{
	/** @return Doctor */
	public function selectById($id)
	{
		return $this->getEntityManager()
				->createQueryBuilder('e')
				->select('e')
				->from(Doctor::class, 'e')
				->where('e.id = :identifier')
				->setParameter('identifier', $id)
				->getQuery()
				->getResult(Query::HYDRATE_ARRAY);
	}

}
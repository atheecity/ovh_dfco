<?php

namespace DF\BreveBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BreveRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BreveRepository extends EntityRepository
{
	/**
	 * Liste des brèves
	 * 
	 * @return Ambigous <multitype:, \Doctrine\ORM\mixed, \Doctrine\ORM\Internal\Hydration\mixed, \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
	 */
	public function getListeBreves()
	{
		$qb = $this->createQueryBuilder('b')
			->orderBy('b.dateCreation', 'ASC');
		
		return $qb->getQuery()->getResult();
	}
	
	/**
	 * Retourne les nb dernière brève publié
	 * 
	 * @param integer $nb_breve Nombre de brève retoruner 
	 * @return Ambigous <multitype:, \Doctrine\ORM\mixed, \Doctrine\ORM\Internal\Hydration\mixed, \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
	 */
	public function getBreveIsPublish($nb_breve)
	{
		$qb = $this->createQueryBuilder('b')
			->where('b.isPublish = true')
			->orderBy('b.datePublication', 'DESC')
			->setMaxResults($nb_breve);
		
		return $qb->getQuery()->getResult();
	}
	
}

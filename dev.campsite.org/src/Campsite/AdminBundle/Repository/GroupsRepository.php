<?php

namespace Campsite\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * GroupsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GroupsRepository extends EntityRepository
{
  /**
   * find Groups By Community
   * @param integer $communityid
   * @return QueryBuilder
   */
  public function findGroupByCommunity($communityId,$limit=0)
  {
    $qb = $this->getEntityManager()->createQueryBuilder();
    $qb->select('g,gu.id,count(gu.id)')
        ->from('Campsite\AdminBundle\Entity\Groups', 'g')	
		->leftJoin('g.users','gu')
		->where('g.community=:id')
		->setParameter('id', $communityId)
		->groupBy('g.id')
		->orderBy('g.id','Desc');
	if($limit!=0)
		$qb->setMaxResults($limit);	
		
	$query = $qb->getQuery();
	return $query->getResult();
  }
  
  
  /**
   * find Total no of users belongs to Group
   * @param integer $communityid
   * @return QueryBuilder
   */
  public function findCountOfUserGroup($groupId)
  {
    $qb = $this->getEntityManager()->createQueryBuilder();
    $qb->select('sum(ug.User)')
        ->from('Campsite\AdminBundle\Entity\UsersGroups', 'ug')			
		->where('ug.group=:id')	
		->setParameter('id', $groupId);
		
		
	$query = $qb->getQuery();
	return $query->getResult();
  }
  public function findUpcomingGroupEvents($groupId, $limit=0) 
  {
  
    $qb = $this->getEntityManager()->createQueryBuilder();
    $qb->select('ge,e')
        ->from('Campsite\AdminBundle\Entity\GroupsEvents', 'ge')
		->leftJoin('ge.event','e')
		->where('ge.group=:id')	
		->setParameter('id', $groupId);

	if($limit!=0)
		$qb->setMaxResults($limit);
		
	$query = $qb->getQuery();
	return $query->getResult();
  }
  
  public function findUserAllowedAddEvent($userId,$groupId)
  {
    $qb = $this->getEntityManager()->createQueryBuilder();
    $qb->select('ug')
        ->from('Campsite\AdminBundle\Entity\UsersGroups', 'ug')			
		->where('ug.group=:groupId')
		->andWhere('ug.fosuser=:userId')
		->setParameter('groupId', $groupId)
		->setParameter('userId', $userId);		
		
	$query = $qb->getQuery();
	return $query->getResult();
  }
  
}
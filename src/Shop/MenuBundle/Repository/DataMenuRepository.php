<?php

namespace Shop\MenuBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DataMenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DataMenuRepository extends EntityRepository {

    public function findByIdOrderedByName($model_id, $auto_id) {
                    
        $query = $this->createQueryBuilder('d')
            ->where('d.modelMenuId = :model_id and d.autoMenuId = :auto_id')
            ->setParameter('model_id', $model_id)
            ->setParameter('auto_id', $auto_id)
            ->orderBy('d.name', 'ASC')
            ->getQuery();
        return $query->getResult();
        
    }

}

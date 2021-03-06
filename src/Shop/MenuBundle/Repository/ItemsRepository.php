<?php

namespace Shop\MenuBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ItemsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItemsRepository extends EntityRepository {

    public function getOneItemById($Id){

        $query = $this->createQueryBuilder('i')
                        ->where('i.id = :Id')
                        ->setParameter('Id', $Id);
        $query = $query->setMaxResults( 1 );
        $query = $query->getQuery();

        return $query->getResult();

    }

    public function findTheLatestOnes($limit){

        $query = $this->createQueryBuilder('i');
        $query = $query->setMaxResults( $limit );
        $query = $query->orderBy('i.id', 'DESC')
            ->getQuery();

        return $query->getResult();

    }

    public function findBySerchCodeOrderedById($serch) {
                  
        //echo $serch;
        $query = $this->createQueryBuilder('i')
            ->where('i.itemId LIKE :serch')
            ->setParameter('serch', '%'.$serch.'%');
                
        $query = $query->orderBy('i.id', 'ASC')
                 ->getQuery();
        
       // echo $query->getSQL();
        
        return $query->getResult();
        
    }    
    
    public function findByIdOrderedById($model_id, $auto_id, $data_id, $side) {
            
        $sideId = $side ? " and i.sideId = :side" : ""; 
                
        $query = $this->createQueryBuilder('i')
            ->where('i.modelMenuId = :model_id and i.autoMenuId = :auto_id and i.dataMenuId = :data_id'.$sideId)
            ->setParameter('model_id', $model_id)
            ->setParameter('auto_id', $auto_id)
            ->setParameter('data_id', $data_id);
        
        if ($side) {
            $query = $query->setParameter('side', $side);                
        }

        $query = $query->orderBy('i.id', 'ASC')
                 ->getQuery();
        return $query->getResult();
        
    }
    
}

<?php

namespace Security\UserBundle\Repository;
#use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Doctrine\ORM\EntityRepository;

class UserRepository extends BaseUserRepository
{
    public function supportsClass($class) {
        return $class === 'Security\UserBundle\Entity\User';
    }
    
}

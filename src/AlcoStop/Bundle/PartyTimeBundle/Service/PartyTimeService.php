<?php
namespace AlcoStop\Bundle\PartyTimeBundle\Service;

use AlcoStop\Bundle\UserBundle\Entity\User;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PartyTimeService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    public function __construct(EntityManager $em, TokenStorage $tokenStorage)
    {
        $this->em           = $em;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return QueryBuilder
     */
    public function getActivitiesListQuery()
    {
        $queryBuilder = $this->em->createQueryBuilder();

        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();

        if ($user->hasRole('ROLE_ADMIN')) {
            $queryBuilder->select('d')
                ->from('PartyTimeBundle:DrinkActivity', 'd')
                ->where('d.userId=:userId')
                ->setParameter('userId', $user->getId(), Type::INTEGER);
        } else {
            $queryBuilder->select('p')
                ->from('PartyTimeBundle:DrinkActivity', 'p');
        }

        return $queryBuilder;
    }
}



<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MatchMaker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MatchMakerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchMaker::class);
    }

    public function getMyMatches($user){

        // We search for the user in the PlayerA column
        $qb = $this->createQueryBuilder('m')
            ->where("m.playerA = :user")
            ->orWhere("m.playerB = :user")
            ->setParameter('user', $user)
        ;
        $query = $qb->getQuery();
        $myMatches = $query->execute();

        return $myMatches;
    }

}

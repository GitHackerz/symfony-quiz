<?php

namespace App\Repository;

use App\Entity\QuizParticipants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizParticipants>
 *
 * @method QuizParticipants|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizParticipants|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizParticipants[]    findAll()
 * @method QuizParticipants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizParticipantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizParticipants::class);
    }

//    /**
//     * @return QuizParticipants[] Returns an array of QuizParticipants objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuizParticipants
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

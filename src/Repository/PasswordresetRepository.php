<?php

namespace App\Repository;

use App\Entity\Passwordreset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Passwordreset>
 *
 * @method Passwordreset|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passwordreset|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passwordreset[]    findAll()
 * @method Passwordreset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasswordresetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Passwordreset::class);
    }

//    /**
//     * @return Passwordreset[] Returns an array of Passwordreset objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Passwordreset
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

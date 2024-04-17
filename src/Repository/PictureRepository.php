<?php

namespace App\Repository;

use App\Entity\Picture;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Picture>
 *
 * @method Picture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Picture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Picture[]    findAll()
 * @method Picture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Picture::class);
    }

    /**
     * Fetches all pictures
     *
     * @return Picture[]
     */
    public function findAllPictures(): array
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }

    /**
     * Fetches the latest picture for trick
     *
     * @return array
     */
    public function findLatestPicturesForTrick(): array
    {
        return $this->createQueryBuilder('p')
            // ->select('p')
            ->join('p.trick', 't')
            ->addSelect('t')
            ->groupBy('t.id')
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Picture[] Returns an array of Picture objects
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

//    public function findOneBySomeField($value): ?Picture
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\Video;
use App\Entity\Trick;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Video>
 *
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * Fetches all Videos
     *
     * @return Video[]
     */
    public function findAllVideos(): array
    {
        return $this->createQueryBuilder('v')
            ->getQuery()
            ->getResult();
    }

    /**
     * Fetches all videos associated with a specific trick
     *
     * @param Trick $trick
     * @return Video[]
     */
    public function findVideosByTrick(Trick $trick): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.trick = :trick')
            ->setParameter('trick', $trick)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Video[] Returns an array of Video objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Video
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

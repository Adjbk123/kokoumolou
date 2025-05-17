<?php

namespace App\Repository;

use App\Entity\CategorieUniversite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieUniversite>
 *
 * @method CategorieUniversite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieUniversite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieUniversite[]    findAll()
 * @method CategorieUniversite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieUniversiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieUniversite::class);
    }

    //    /**
    //     * @return CategorieUniversite[] Returns an array of CategorieUniversite objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CategorieUniversite
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiant>
 *
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }
    public function countStudentsByVillage()
    {
        return $this->createQueryBuilder('e')
            ->select('v.libelle as village, COUNT(e.id) as nbStudents')
            ->leftJoin('e.village', 'v')
            ->groupBy('v.libelle')
            ->getQuery()
            ->getResult();
    }
    public function countStudentsByFiliere()
    {
        return $this->createQueryBuilder('e')
            ->select('f.libelle as filiere, COUNT(e.id) as nbStudents')
            ->leftJoin('e.filiere', 'f')
            ->groupBy('f.libelle')
            ->getQuery()
            ->getResult();
    }

    public function countStudentsBySexe()
    {
        return $this->createQueryBuilder('e')
            ->select('e.sexe as sexe, COUNT(e.id) as nbStudents')
            ->groupBy('e.sexe')
            ->getQuery()
            ->getResult();
    }
    public function countStudentsBySerie()
    {
        return $this->createQueryBuilder('e')
            ->select('s.libelle as serie, COUNT(e.id) as nbStudents')
            ->leftJoin('e.serie', 's')
            ->groupBy('s.libelle')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Etudiant[] Returns an array of Etudiant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Etudiant
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

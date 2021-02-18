<?php

namespace App\Repository;

use App\Entity\TarifHoraire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TarifHoraire|null find($id, $lockMode = null, $lockVersion = null)
 * @method TarifHoraire|null findOneBy(array $criteria, array $orderBy = null)
 * @method TarifHoraire[]    findAll()
 * @method TarifHoraire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarifHoraireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TarifHoraire::class);
    }

    // /**
    //  * @return TarifHoraire[] Returns an array of TarifHoraire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TarifHoraire
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

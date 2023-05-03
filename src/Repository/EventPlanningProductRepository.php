<?php

namespace App\Repository;

use App\Entity\EventPlanningProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EventPlanningProduct>
 *
 * @method EventPlanningProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventPlanningProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventPlanningProduct[]    findAll()
 * @method EventPlanningProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventPlanningProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventPlanningProduct::class);
    }

    public function save(EventPlanningProduct $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EventPlanningProduct $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EventPlanningProduct[] Returns an array of EventPlanningProduct objects
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

//    public function findOneBySomeField($value): ?EventPlanningProduct
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

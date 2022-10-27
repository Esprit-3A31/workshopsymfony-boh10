<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Student>
 *
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function add(Student $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Student $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function sortByNCE()
    {
        $qb= $this->createQueryBuilder('s')->orderBy('s.nce','DESC');
        return $qb->getQuery()->getResult();
    }

    public function topStudent(){
        $entityManager= $this->getEntityManager();
        $query=$entityManager->createQuery("SELECT s FROM APP\Entity\Student s WHERE s.Moyenne >= 15");
        return $query->getResult();
    }
    public  function getStudentByClassroom($id){
        $qb=$this->createQueryBuilder('s')->join('s.classRoom','c')->addSelect('s')->where('c.id=:id')->setParameter('id',$id);
        return $qb->getQuery()->getResult();


    }
}
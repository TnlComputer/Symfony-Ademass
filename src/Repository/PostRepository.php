<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Post::class);
  }

  //    /**
//     * @return Post[] Returns an array of Post objects
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

  //    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

  public function findPost()
  {
    return $this->getEntityManager()
      ->createQuery('
        SELECT post.id, post.title, post.description, post.type
        FROM App:Post post
    #    WHERE post.id =:id
        ')
      ->setParameter('id', $id)
      ->getSingleResult();
  }

    public function findAllPost()
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT post.id, post.title, post.description, post.type, post.creation_date, post.url, user.id AS user_id, user.email AS user_email
                FROM App:Post post
                JOIN post.user user
                ORDER BY post.id DESC
            ')
            ->getResult();
    }

}
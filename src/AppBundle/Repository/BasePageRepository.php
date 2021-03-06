<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PagesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BasePageRepository extends EntityRepository
{
    public function searchByString(string $str)
    {
        return $this->createQueryBuilder('p')
            ->where('p.title LIKE :str OR p.subtitle LIKE :str OR p.description LIKE :str')
            ->andWhere('p NOT INSTANCE OF AppBundle\Entity\Page\Vacancy')
            ->setParameter('str', '%' . $str . '%')
            ->getQuery()
            ->getResult();
    }
}

<?php

namespace FourChimps\ArticleBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * TagRepository
 *
 */
class TagRepository extends EntityRepository {

    function getActiveTags() {
        $queryBuilder = $this->createQueryBuilder('t')
            ->orderBy('t.tag', 'ASC')
        ;

        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }



}
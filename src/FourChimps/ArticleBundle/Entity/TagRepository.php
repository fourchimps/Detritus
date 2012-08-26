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

    function getFilteredVisibleTags($term) {
        $queryBuilder = $this->createQueryBuilder('t')
            ->orderBy('t.tag', 'ASC')
            ->andWhere('t.tag LIKE :term')
            ->setParameter('term', '%' . $term . '%');
        ;

        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }


}
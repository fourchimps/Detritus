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

    function getFilteredVisibleTags($term, $minimumLength) {
        $queryBuilder = $this->createQueryBuilder('t')
            ->orderBy('t.tag', 'ASC')
            ->andWhere('t.tag LIKE :term')
            ->setParameter('term', '%' . $term . '%');
        ;

        if ($minimumLength > 0) {
            $queryBuilder
                ->andWhere('LENGTH(t.tag) > :minLength')
                ->setParameter('minLength', $minimumLength);
        }

        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    /**
     *
     */
    public function getTableStats() {

    }

}
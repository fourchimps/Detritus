<?php

namespace FourChimps\AdminBundle\Controller;

class DataTableColumn {
    private $alias;
    private $searchBy;
    private $sortBy;
    private $selectBy;

    function __construct($alias, $searchBy, $sortBy, $selectBy)
    {
        $this->setAlias($alias);
        $this->setSearchBy($searchBy);
        $this->setSortBy($sortBy);
        $this->setSelectBy($selectBy);
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setSearchBy($searchBy)
    {
        $this->searchBy = $searchBy;
    }

    public function getSearchBy()
    {
        return $this->searchBy;
    }

    public function setSelectBy($selectBy)
    {
        $this->selectBy = $selectBy;
    }

    public function getSelectBy()
    {
        return $this->selectBy;
    }

    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
    }

    public function getSortBy()
    {
        return $this->sortBy;
    }
}
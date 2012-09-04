<?php

namespace FourChimps\AdminBundle\Controller;

class DataTableColumn {
    private $alias;
    private $searchBy;
    private $sortBy;
    private $selectBy;
    private $metaData;

    function __construct($alias, $searchBy, $sortBy, $selectBy, $metaData)
    {
        $this->setAlias($alias);
        $this->setSearchBy($searchBy);
        $this->setSortBy($sortBy);
        $this->setSelectBy($selectBy);
        $this->setMetaData($metaData);
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

    public function setMetaData($metaData)
    {
        $this->metaData = $metaData;
    }

    public function isMetaData()
    {
        return $this->metaData;
    }
}
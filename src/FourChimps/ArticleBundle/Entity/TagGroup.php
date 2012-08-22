<?php

namespace FourChimps\ArticleBundle\Entity;

use FourChimps\ArticleBundle\Entity\Tag;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * FourChimps\ArticleBundle\Entity\TagGroup
 *
 * @ORM\Table(name="tag_group")
 * @ORM\Entity(repositoryClass="FourChimps\ArticleBundle\Entity\TagGroupRepository")
 */
class TagGroup
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=40)
     */
    private $name;

    /**
     * @var boolean $navigable
     *
     * @ORM\Column(name="navigable", type="boolean")
     */
    private $navigable;

    /**
     * @var integer $sort_order
     *
     * @ORM\Column(name="sort_order", type="integer")
     */
    private $sortOrder;

    /**
     * @var boolean $visible
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;

    /**
     * @var boolean $active
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var ArrayCollection $tags
     *
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="tagGroup")
     */
    private $tags;


    function __construct()
    {
        $this->tags = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return TagGroup
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set navigable
     *
     * @param boolean $navigable
     * @return TagGroup
     */
    public function setNavigable($navigable)
    {
        $this->navigable = $navigable;
    
        return $this;
    }

    /**
     * Get navigable
     *
     * @return boolean 
     */
    public function getNavigable()
    {
        return $this->navigable;
    }

    /**
     * Set sort_order
     *
     * @param integer $sortOrder
     * @return TagGroup
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    
        return $this;
    }

    /**
     * Get sort_order
     *
     * @return integer 
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return TagGroup
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    
        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return TagGroup
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }


    /**
     * @param $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }
}

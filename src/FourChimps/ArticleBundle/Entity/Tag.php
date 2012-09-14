<?php

namespace FourChimps\ArticleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FourChimps\ArticleBundle\Entity\TagGroup;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FourChimps\ArticleBundle\Entity\Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="TagRepository")
 */
class Tag {
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $tag
     *
     * @ORM\Column(name="tag", type="string", length=255)
     */
    private $tag;

    /**
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="tags")
     *
     * @var ArrayCollection $articles
     */
    private $articles;


    /**
     * @var TagGroup $tagGroup
     *
     * @ORM\ManyToOne(targetEntity="FourChimps\ArticleBundle\Entity\TagGroup", inversedBy="tags")
     * @ORM\JoinColumn(name="tag_group_id", referencedColumnName="id")
     */
    private $tagGroup;

    /**
     * @var boolean $navigable
     *
     * @ORM\Column(name="navigable", type="boolean")
     */
    private $navigable;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    public function __construct() {
        $this->articles= new ArrayCollection();
    }

    public function __toString() {
        return $this->getTag();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set tag
     *
     * @param string $tag
     */
    public function setTag($tag) {
        $this->tag = $tag;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag() {
        return $this->tag;
    }

    /**
     * Add Article
     *
     * @param Article $article
     */
    public function addArticles(Article $article)
    {
        $this->articles[] = $article;
    }

    /**
     * Get questions
     *
     * @return ArrayCollection
     */
    public function getQuestions()
    {
        return $this->articles;
    }

    /**
     * Add article
     *
     * @param Article $article
     * @return Tag
     */
    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
    
        return $this;
    }

    /**
     * Remove article
     *
     * @param Article $article
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param TagGroup $tagGroup
     */
    public function setTagGroup($tagGroup)
    {
        $this->tagGroup = $tagGroup;
    }

    /**
     * @return TagGroup
     */
    public function getTagGroup()
    {
        return $this->tagGroup;
    }

    /**
     * @param boolean $navigable
     */
    public function setNavigable($navigable)
    {
        $this->navigable = $navigable;
    }

    /**
     * @return boolean
     */
    public function isNavigable()
    {
        return $this->navigable;
    }
}
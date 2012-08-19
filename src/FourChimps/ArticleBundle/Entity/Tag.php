<?php

namespace FourChimps\ArticleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

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
}
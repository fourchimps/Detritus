<?php

namespace FourChimps\ArticleBundle\Entity;

use FourChimps\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FourChimps\ArticleBundle\Entity\Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="ArticleRepository")
 */
class Article
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
     * @var string $headline
     *
     * @ORM\Column(name="headline", type="string", length=255)
     */
    private $headline;

    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"headline"}, unique=true, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;


    /**
     * @var text $intro
     *
     * @ORM\Column(name="intro", type="text")
     */
    private $intro;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles")
     * @ORM\JoinTable(name="article_tag",
     *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     *
     * @var ArrayCollection $tags
     */
    private $tags;

    /**
     * @var User $author
     *
     * @ORM\ManyToOne(targetEntity="FourChimps\UserBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

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
        // initialise any collections
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
     * Set headline
     *
     * @param string $headline
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set intro
     *
     * @param text $intro
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    }

    /**
     * Get intro
     *
     * @return text 
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Add tag
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Get tags
     *
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Has tag
     *
     * @param Tag $tag
     *
     * @return boolean
     */
    public function hasTag($tag) {
        return $this->tags->contains($tag);
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }


    /**
     * Remove tags
     *
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return string
     */
    public function getTagsAsJson() {
        $arOut = array();
        foreach ($this->getTags() as $tag) {
            $arOut[] = $tag->__toString();
        }
        return json_encode($arOut);
    }

    public function setTagsAsJson($tagString) {

    }

}
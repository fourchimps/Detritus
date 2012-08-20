<?php 
namespace FourChimps\ArticleBundle\DataFixtures\ORM;

use FourChimps\ArticleBundle\Entity\Tag;
use FourChimps\LipsumBundle\FourChimpsLipsumBundle;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection as DI;

class LoadTagTestData extends AbstractFixture implements OrderedFixtureInterface, DI\ContainerAwareInterface
{
	const COUNT=100;
	
	private $container;
	
	public function setContainer(DI\ContainerInterface $container = null)
	{
		$this->container = $container;
	}
	
	
    public function load(ObjectManager $manager)
    {
    	$lipsumGenerator = $this->container->get('fourchimps_lipsum.lipsum');
    	
    	$words = array();
    	
    	while(count($words) < LoadTagTestData::COUNT) {
    		$new_words = explode(
                ' ',
                preg_replace(
                    '/[^a-z\s]/',
                    '',
                    strtolower(
                        $lipsumGenerator->get(
                            FourChimpsLipsumBundle::LIPSUM_WORD,
                            LoadTagTestData::COUNT
                        )
                    )
                )
            );
    		$words = array_unique($words + $new_words);
    	}
    	
    	// Tags
    	for ($i=0 ; $i<LoadTagTestData::COUNT; $i++) {
    		$tag = new Tag();
    		$tag->setTag($words[$i]);
    		$manager->persist($tag);
    		$this->addReference('tag-'.$i, $tag );
    	}
       
        $manager->flush();
    }
    
    public function getOrder()
    {
    	return 1; // load this fixture second
    }
}
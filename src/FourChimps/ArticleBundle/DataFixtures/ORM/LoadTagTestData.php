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
    	
    	$words = array('layout_hero','layout_section');
    	
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

        $tagGroupPlaceholder = $this->getReference('taggroup-placeholders');
        $tagGroupUser = $this->getReference('taggroup-user');
        $tagGroupSection1 = $this->getReference('taggroup-section1');
        $tagGroupSection2 = $this->getReference('taggroup-section2');
        $tagGroupSection3 = $this->getReference('taggroup-section3');

    	// Tags
    	for ($i=0 ; $i<LoadTagTestData::COUNT; $i++) {
    		$tag = new Tag();
    		$tag->setTag($words[$i]);

            if ($i < 2) {
                $tag->setTagGroup($tagGroupPlaceholder);
            } elseif ($i < 6) {
                $tag->setTagGroup($tagGroupSection1);
            } elseif ($i < 11) {
                $tag->setTagGroup($tagGroupSection2);
            } elseif ($i < 14) {
                $tag->setTagGroup($tagGroupSection3);
            } else {
                $tag->setTagGroup($tagGroupUser);
            }

    		$manager->persist($tag);
    		$this->addReference('tag-'.$i, $tag );
    	}
       
        $manager->flush();
    }
    
    public function getOrder()
    {
    	return 20; // load this fixture second
    }
}
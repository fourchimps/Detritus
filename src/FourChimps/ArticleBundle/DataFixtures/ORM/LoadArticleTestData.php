<?php 
namespace FourChimps\ArticleBundle\DataFixtures\ORM;

use FourChimps\ArticleBundle\Entity\Article;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection as DI;


class LoadArticleTestData extends AbstractFixture implements OrderedFixtureInterface, DI\ContainerAwareInterface
{
	const COUNT=10;
	
	private $container;
	
	public function setContainer(DI\ContainerInterface $container = null)
	{
		$this->container = $container;
	}
	
	
    public function load(ObjectManager $manager)
    {
    	$lipsumGenerator = $this->container->get('fourchimps_lipsum.lipsum');
    	

    	for ($i=0 ; $i<LoadArticleTestData::COUNT; $i++) {

            // Create Article
            $article = new Article();


            // Set up the test data from the Lipsum Service
            $article->setHeadline($lipsumGenerator->get('words', rand(2,7), false));
            $body = $lipsumGenerator->get('paragraphs', rand(1,2), rand(0,1));
            $article->setBody($body);
            if (strlen($body) > 100) {
                $article->setIntro(
                    substr($article->getBody(), 0, 100) . '...'
                );
            } else {
                $article->setIntro($body);
            }

            $article->setAuthor($this->getReference('user-user'));

            // Add some tags
            $countTagsToAdd = rand(0,8);
            for ($j=0; $j < $countTagsToAdd; $j++ ) {

                $k = rand(0, LoadTagTestData::COUNT-1);
                if ( ! $article->hasTag($this->getReference('tag-'.$k))) {
                    $article->addTag($this->getReference('tag-'.$k));
                }
            }

            $manager->persist($article);

    	}
       
        $manager->flush();
    }
    
    public function getOrder()
    {
    	return 3; // load this fixture second
    }
}
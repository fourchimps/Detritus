<?php 
namespace FourChimps\ArticleBundle\DataFixtures\ORM;

use FourChimps\ArticleBundle\Entity\Article;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection as DI;


class LoadArticleTestData extends AbstractFixture implements OrderedFixtureInterface, DI\ContainerAwareInterface
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
    	

    	for ($i=0 ; $i<LoadArticleTestData::COUNT; $i++) {

            // Create Article
            $article = new Article();


            // Set up the test data from the Lipsum Service
            $article->setHeadline($lipsumGenerator->get('words', rand(2,7), false));
            $body = $lipsumGenerator->get('paragraphs', rand(1,2), rand(0,1));
            $article->setBody($body);


            if (strlen($body) > 254) {
                $article->setIntro(
                    substr($article->getBody(), 0, 254) . '...'
                );
            } else {
                $article->setIntro($body);
            }

            if ($i % 2 == 0) {
                $article->setAuthor($this->getReference('user-user'));
            } else {
                $article->setAuthor($this->getReference('user-admin2'));
            }

            // Add some tags
            $countTagsToAdd = rand(0,24);
            for ($j=0; $j < $countTagsToAdd; $j++ ) {

                $k = rand(2, LoadTagTestData::COUNT-1);
                if ( ! $article->hasTag($this->getReference('tag-'.$k))) {
                    $article->addTag($this->getReference('tag-'.$k));
                }
            }

            // first three articles should be hero:
            if ($i < 3) {
                $article->setHero(true);
                $article->setSection(false);
                $article->publish();
            } elseif ($i >= 3 && $i < 6) {
                // next three articles should be section (tag-1)
                $article->setHero(false);
                $article->setSection(true);
                $article->publish();
            } else {
                $article->setHero(false);
                $article->setSection(false);
                if (rand(0,10) < 7) {
                    $article->publish();
                } else {
                    $article->unPublish();
                }
            }

            // Articles were written some time in the last 3 years
            $date = new \DateTime();
            $age = rand(0, 60*60*24*365*3);
            $dateInterval = new \DateInterval("PT{$age}S");
            $date->sub($dateInterval);
            $article->setCreated($date);

            // half the articles have been edited at some random time since
            if (rand(0, 1) == 1) {
                $updateAge = rand(0, $age);
                $dateInterval = new \DateInterval("PT{$updateAge}S");
                $date->add($dateInterval);
                //$article->setUpdated($date);
            } else {
                $article->setUpdated($date);
            }

            $manager->persist($article);
    	}
       
        $manager->flush();
    }
    
    public function getOrder()
    {
    	return 40; // load this fixture second
    }
}
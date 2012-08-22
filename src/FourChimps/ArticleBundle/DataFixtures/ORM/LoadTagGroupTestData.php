<?php 
namespace FourChimps\ArticleBundle\DataFixtures\ORM;

use FourChimps\ArticleBundle\Entity\TagGroup;
use FourChimps\LipsumBundle\FourChimpsLipsumBundle;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadTagGroupTestData extends AbstractFixture implements OrderedFixtureInterface
{

	

    public function load(ObjectManager $manager)
    {
    	// TagGroups
    	$tagGroup1 = new TagGroup();
        $tagGroup1->setName('Site Placeholders');
        $tagGroup1->setActive(true);
        $tagGroup1->setNavigable(false);
        $tagGroup1->setVisible(false);
        $tagGroup1->setSortOrder(0);

        $manager->persist($tagGroup1);

        $tagGroup2 = new TagGroup();
        $tagGroup2->setName('User land');
        $tagGroup2->setActive(true);
        $tagGroup2->setNavigable(false);
        $tagGroup2->setVisible(true);
        $tagGroup2->setSortOrder(0);

        $manager->persist($tagGroup2);

        $tagGroup3 = new TagGroup();
        $tagGroup3->setName('Lorem');
        $tagGroup3->setActive(true);
        $tagGroup3->setNavigable(true);
        $tagGroup3->setVisible(false);
        $tagGroup3->setSortOrder(1);

        $manager->persist($tagGroup3);

        $tagGroup4 = new TagGroup();
        $tagGroup4->setName('Ipsum');
        $tagGroup4->setActive(true);
        $tagGroup4->setNavigable(true);
        $tagGroup4->setVisible(false);
        $tagGroup4->setSortOrder(2);

        $manager->persist($tagGroup4);

        $tagGroup5 = new TagGroup();
        $tagGroup5->setName('Vestibulum');
        $tagGroup5->setActive(true);
        $tagGroup5->setNavigable(true);
        $tagGroup5->setVisible(false);
        $tagGroup5->setSortOrder(2);

        $manager->persist($tagGroup5);


        $this->addReference('taggroup-placeholders', $tagGroup1);
        $this->addReference('taggroup-user', $tagGroup2);
        $this->addReference('taggroup-section1', $tagGroup3);
        $this->addReference('taggroup-section2', $tagGroup4);
        $this->addReference('taggroup-section3', $tagGroup5);

        $manager->flush();
    }
    
    public function getOrder()
    {
    	return 10; // load this fixture first
    }
}
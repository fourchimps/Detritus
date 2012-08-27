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

        $tagGroupUser = new TagGroup();
        $tagGroupUser->setName('User land');
        $tagGroupUser->setActive(true);
        $tagGroupUser->setNavigable(false);
        $tagGroupUser->setVisible(true);
        $tagGroupUser->setSortOrder(0);

        $manager->persist($tagGroupUser);

        $tagGroupNavOne = new TagGroup();
        $tagGroupNavOne->setName('Lorem');
        $tagGroupNavOne->setActive(true);
        $tagGroupNavOne->setNavigable(true);
        $tagGroupNavOne->setVisible(false);
        $tagGroupNavOne->setSortOrder(1);

        $manager->persist($tagGroupNavOne);

        $tagGroupNavTwo = new TagGroup();
        $tagGroupNavTwo->setName('Ipsum');
        $tagGroupNavTwo->setActive(true);
        $tagGroupNavTwo->setNavigable(true);
        $tagGroupNavTwo->setVisible(false);
        $tagGroupNavTwo->setSortOrder(2);

        $manager->persist($tagGroupNavTwo);

        $tagGroupNavThree = new TagGroup();
        $tagGroupNavThree->setName('Vestibulum');
        $tagGroupNavThree->setActive(true);
        $tagGroupNavThree->setNavigable(true);
        $tagGroupNavThree->setVisible(false);
        $tagGroupNavThree->setSortOrder(3);

        $manager->persist($tagGroupNavThree);

        $this->addReference('taggroup-user', $tagGroupUser);
        $this->addReference('taggroup-section1', $tagGroupNavOne);
        $this->addReference('taggroup-section2', $tagGroupNavTwo);
        $this->addReference('taggroup-section3', $tagGroupNavThree);

        $manager->flush();
    }
    
    public function getOrder()
    {
    	return 10; // load this fixture first
    }
}
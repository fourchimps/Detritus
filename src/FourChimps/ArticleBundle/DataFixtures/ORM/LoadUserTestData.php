<?php 
namespace FourChimps\ArticleBundle\DataFixtures\ORM;

use FourChimps\UserBundle\Entity\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
//use Symfony\Component\DependencyInjection as DI;

class LoadUserTestData extends AbstractFixture implements OrderedFixtureInterface /*, DI\ContainerAwareInterface */
{

//	private $container;
	
//	public function setContainer(DI\ContainerInterface $container = null)
//	{
//		$this->container = $container;
//	}
	
	
    public function load(ObjectManager $manager)
    {
//    	$lipsumGenerator = $this->container->get('fourchimps_lipsum.lipsum');

        $superAdminUser = new User();
        $superAdminUser->setUsername('super');
        $superAdminUser->setFirstName('Senna');
        $superAdminUser->setLastName('Tenna-Hennasson');
        $superAdminUser->setEmail('super@fourchimps.com');
        $superAdminUser->setPlainPassword('super');
        $superAdminUser->addRole('ROLE_SUPER_ADMIN');
        $superAdminUser->setEnabled(TRUE);
        $manager->persist($superAdminUser);

        $adminUser = new User();
        $adminUser->setUsername('admin');
        $adminUser->setFirstName('Arty');
        $adminUser->setLastName('Admin');
        $adminUser->setEmail('admin@fourchimps.com');
        $adminUser->setPlainPassword('admin');
        $adminUser->addRole('ROLE_ADMIN');
        $adminUser->setEnabled(TRUE);
        $manager->persist($adminUser);

        $user = new User();
        $user->setUsername('user');
        $user->setFirstName('Chester');
        $user->setLastName('Chimp');
        $user->setEmail('user@fourchimps.com');
        $user->setPlainPassword('user');
        $user->addRole('ROLE_USER');
        $user->setEnabled(TRUE);
        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername('admin2');
        $user2->setFirstName('Gunther');
        $user2->setLastName('McChunker');
        $user2->setEmail('gunther@fourchimps.com');
        $user2->setPlainPassword('admin2');
        $user2->addRole('ROLE_ADMIN');
        $user2->setEnabled(TRUE);
        $manager->persist($user2);

        // store references so we can build other fixtures
        $this->addReference('user-super', $superAdminUser );
        $this->addReference('user-admin', $adminUser );
        $this->addReference('user-user', $user );
        $this->addReference('user-admin2', $user2 );

        $manager->flush();
    }
    
    public function getOrder()
    {
    	return 30; // load this fixture second
    }
}
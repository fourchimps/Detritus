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
        $superAdminUser->setEmail('super@fourchimps.com');
        $superAdminUser->setPlainPassword('super');
        $superAdminUser->addRole('ROLE_SUPER_ADMIN');
        $superAdminUser->setEnabled(TRUE);
        $manager->persist($superAdminUser);

        $adminUser = new User();
        $adminUser->setUsername('admin');
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

        // store references so we can build other fixtures
        $this->addReference('user-super', $superAdminUser );
        $this->addReference('user-admin', $adminUser );
        $this->addReference('user-user',  $user );

        $manager->flush();
    }
    
    public function getOrder()
    {
    	return 30; // load this fixture second
    }
}
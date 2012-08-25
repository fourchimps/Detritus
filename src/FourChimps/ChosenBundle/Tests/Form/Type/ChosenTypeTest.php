<?php

namespace SevenCity\ChosenBundle\Tests\Form\Type;

use Symfony\Tests\Component\Form\Extension\Core\Type\TypeTestCase;

use SevenCity\ChosenBundle\Form\Type\ChosenType;

/**
 * Chosen type test
 *
 * @author Shaun Masterman 
 */
class ChosenTypeTest extends TypeTestCase {
	
	/**
	 * @override
	 */
	protected function setUp()	{
		parent::setUp();
	
		$this->factory->addType(new ChosenType());
	}
	
	/**
	 * Checks default prompt property
	 */
	public function testDefaultPrompt(){
		$form = $this->factory->create('chosen');
		$view = $form->createView();
		$prompt = $view->get('prompt');
	
		$this->assertNull($prompt);
	}
	
	/**
	 * Checks prompt property
	 */
	public function testPrompt(){
		$form = $this->factory->create('chosen', null, array('prompt' => 'TESTprompt'));
		$view = $form->createView();
		$prompt = $view->get('prompt');
	
		$this->assertEquals($prompt, 'TESTprompt');	
	}
	
	/**
	 * Checks default ajax  property
	 */
	public function testDefaultAjax(){
		$form = $this->factory->create('chosen');
		$view = $form->createView();
		$ajax= $view->get('ajax');
	
		$this->assertNull($ajax);
	}
	
	
	/**
	 * Checks ajax property
	 */
	public function testAjax(){
		$form = $this->factory->create('chosen', null, array(
				'ajax' => array(
						'url' => '/url/to/data',
						'dataType' => 'json',
            			'cacheResults' => true
						)
				));
		$view = $form->createView();
		$ajax = $view->get('ajax');
	
		$this->assertEquals($ajax, array(
						'url' => '/url/to/data',
						'dataType' => 'json',
            			'cacheResults' => true
						));
	}
	
	/**
	 * Checks default plugin property
	 */
	public function testDefaultPlugins() {
		$form = $this->factory->create('chosen');
		$view = $form->createView();
		$plugins= $view->get('ajax');
		
		$this->assertNull($plugins);
		
	}
	
	/**
	 * Tests all allowed plugins property
	 */
	public function testPlugins(){
		$form = $this->factory->create('chosen', null, array(
				'plugins' => 'tags prompt focus autocomplete ajax arrow' 
		));
		$view = $form->createView();
		$plugins = $view->get('plugins');
	
		$this->assertEquals($plugins, 'tags prompt focus autocomplete ajax arrow');
	}
	
	/**
	 * Tests non existent plugin throw an exception
	 */
// TODO: dont know if I should be throwing an exception here - need to look at the JS to see if it just ignores bad extensions or errors... 	
// 	public function testNonExistanntPluginThrowsException(){
// 		$this->setExpectedException('Symfony\Component\Form\Exception\CreationException');
// 		$form = $this->factory->create('chosen', null, array('plugins' => 'this set of plogins should not exist'));
// 	}
	
	/**
	 * Checks the default required property
	 */
	public function testDefaultRequired()
	{
		$form = $this->factory->create('chosen');
		$view = $form->createView();
		$required = $view->get('required');
	
		$this->assertFalse($required);
	}
	
	/**
	 * Checks the allowed values of the required property
	 */
	public function testRequired()
	{
		$this->setExpectedException('Symfony\Component\Form\Exception\CreationException');
		$form = $this->factory->create('chosen', null, array('required' => true));
	}
}
<?php

namespace SevenCity\ChosenBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

/**
 * Chosen type
 *
 * @author Shaun Masterman 
 */
class ChosenType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
         $builder
             ->setAttribute('prompt', $options['prompt'])
             ->setAttribute('ajax', $options['ajax'])
             ->setAttribute('plugins', $options['plugins'])
		;
	}
    
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form)
    {
         $view
	           ->set('prompt', $form->getAttribute('prompt'))
	           ->set('ajax', $form->getAttribute('ajax'))
	           ->set('plugins', $form->getAttribute('plugins'))
         ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'required' => false,
        	'plugins' => null,
        	'prompt'=> null,
        	'ajax'=>null,		
	
        		
	
        		
        );
    }
    
    /**
     * Returns the allowed option values for each option (if any).
     *
     * @param array $options
     *
     * @return array The allowed option values
     */
    public function getAllowedOptionValues(array $options)
    {
        return array(
        		'required' => array(false),
//        		'plugin' => array(false) // plugin is a space separated string of values that must have corresponding .js files...
        	);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
    {
        return 'textarea';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'chosen';
    }
}

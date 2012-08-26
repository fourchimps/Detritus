<?php

namespace FourChimps\TagEditBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

/**
 * TagEdit type
 *
 * @author Shaun Masterman < shaun@masterman.com >
 */
class TagEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
             ->setAttribute('tagSource', $options['tagSource'])
             ->setAttribute('sortable', $options['sortable'])
             ->setAttribute('triggerKeys', $options['triggerKeys'])
             ->setAttribute('minimumLength', $options['minimumLength'])
             ->setAttribute('allowNewTags', $options['allowNewTags'])
             ->setAttribute('caseSensitive', $options['caseSensitive'])
             ->setAttribute('highlightOnExistColor', $options['highlightOnExistColor'])
             ->setAttribute('maxTags', $options['maxTags'])
		;
	}
    
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['tagSource'] = $form->getAttribute('tagSource');
        $view->vars['sortable'] = $form->getAttribute('sortable');
        $view->vars['triggerKeys'] = $form->getAttribute('triggerKeys');
        $view->vars['minimumLength'] = $form->getAttribute('minimumLength');
        $view->vars['allowNewTags'] = $form->getAttribute('allowNewTags');
        $view->vars['caseSensitive'] = $form->getAttribute('caseSensitive');
        $view->vars['highlightOnExistColor'] = $form->getAttribute('highlightOnExistColor');
        $view->vars['maxTags'] = $form->getAttribute('maxTags');
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'tagSource'             => null,
            'triggerKeys'           => null,
            'minimumLength'         => null,
            'allowNewTags'          => null,
            'caseSensitive'         => null,
            'highlightOnExistColor' => null,
            'maxTags'               => null,
            'sortable'              => null,
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
        return array();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tag_edit';
    }
}

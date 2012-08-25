<?php

namespace FourChimps\CKEditorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

/**
 * CKEditor type
 *
 */
class CKEditorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('toolbar', $options['toolbar'])
            ->setAttribute('ui_color', $options['ui_color'])
            ->setAttribute('skin', $options['skin'])
            ->setAttribute('extraPlugins', $options['extraPlugins'])
            ->setAttribute('removePlugins', $options['removePlugins'])
            ->setAttribute('height', $options['height'])
            ->setAttribute('resize_maxWidth', $options['resize_maxWidth'])
            ->setAttribute('autoGrow_minHeight', $options['autoGrow_minHeight'])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view
            ->set('toolbar', $form->getAttribute('toolbar'))
            ->set('ui_color', $form->getAttribute('ui_color'))
        	->set('skin', $form->getAttribute('skin'))
        	->set('extraPlugins', $form->getAttribute('extraPlugins'))
        	->set('removePlugins', $form->getAttribute('removePlugins'))
        	->set('height', $form->getAttribute('height'))
        	->set('resize_maxWidth', $form->getAttribute('resize_maxWidth'))
        	->set('autoGrow_minHeight', $form->getAttribute('autoGrow_minHeight'))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'required' => false,
            'toolbar' => array(
                array(
                    'name' => 'document',
                    'items' => array('Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates')
                ),
                array(
                    'name' => 'clipboard',
                    'items' => array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo')
                ),
                array(
                    'name' => 'editing',
                    'items' => array('Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt')
                ),
                array(
                    'name' => 'forms',
                    'items' => array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField')
                ),
                '/',
                array(
                    'name' => 'basicstyles',
                    'items' => array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat')
                ),
                array(
                    'name' => 'paragraph',
                    'items' => array('NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl')
                ),
                array(
                    'name' => 'links',
                    'items' => array('Link','Unlink','Anchor')
                ),
                array(
                    'name' => 'insert',
                    'items' => array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak')
                ),
                '/',
                array(
                    'name' => 'styles',
                    'items' => array('Styles','Format','Font','FontSize')
                ),
                array(
                    'name' => 'colors',
                    'items' => array('TextColor','BGColor')
                ),
                array(
                    'name' => 'tools',
                    'items' => array('Maximize', 'ShowBlocks','-','About')
                )
            ),
            'ui_color' => null,
        	'skin' => null,
        	'resize_maxWidth' => null,
        	'extraPlugins' => null,
        	'height' => null,
        	'autoGrow_minHeight'  => null,
        	'removePlugins'  => null,
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
        return array('required' => array(false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'textarea';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ckeditor';
    }
}

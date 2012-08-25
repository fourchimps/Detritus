<?php

namespace FourChimps\CKEditorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * FourChimps CKEditor bundle
 * 
 */
class FourChimpsCKEditorBundle extends Bundle
{
    public static $defaultToolbar = array(
        array(
            'name' => 'document',
            'items' => array('Source','-','NewPage')
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
            'name' => 'basicstyles',
            'items' => array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat')
        ),
        '/',
        array(
            'name' => 'styles',
            'items' => array('Format')
        ),
        array(
            'name' => 'paragraph',
            'items' => array('NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock')
        ),
        array(
            'name' => 'insert',
            'items' => array('Image','Table','BA-II','HorizontalRule','SpecialChar','PageBreak')
        ),
    );
}

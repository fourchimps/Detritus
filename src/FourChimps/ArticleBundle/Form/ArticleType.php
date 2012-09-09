<?php

namespace FourChimps\ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FourChimps\CKEditorBundle\FourChimpsCKEditorBundle;
use Symfony\Component\Form\ResolvedFormTypeInterface;

class ArticleType extends AbstractType
{
    private $tagDataURI;

    public function __construct($tagDataURI)
    {
        $this->tagDataURI = $tagDataURI . '?minimumLength=3';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('headline')
            ->add('body', 'ckeditor', array(
                'toolbar' => FourChimpsCKEditorBundle::$defaultToolbar,
                'skin' => 'BootstrapCK-Skin',
                'resize_maxWidth' => '%',
                'extraPlugins' => 'baii,autogrow,code',
                'height' => 100,
                'autoGrow_minHeight' => 100,
                'removePlugins' => 'elementspath,resize',
            ))
            ->add('intro')
            ->add('tagsAsJson', 'tag_edit', array(
                'label' => 'Tags',
                'tagSource' => $this->tagDataURI,
                'highlightOnExistColor' => '#BD362F',
                'maxTags' => 10,
                'sortable' => true,
                'minimumLength' => 3,
                'allowNewTags' => true,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FourChimps\ArticleBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'fourchimps_articlebundle_articletype';
    }

}

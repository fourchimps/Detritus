<?php

namespace FourChimps\ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FourChimps\CKEditorBundle\FourChimpsCKEditorBundle;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('headline')
            ->add('body', 'ckeditor', array(
                'toolbar' => FourChimpsCKEditorBundle::$defaultToolbar,
                'skin' => 'BootstrapCK-Skin',
                'resize_maxWidth' => '%',
                'extraPlugins' => 'baii,autogrow',
                'height' => 100,
                'autoGrow_minHeight' => 100,
                'removePlugins' => 'elementspath,resize',
            ))
            ->add('intro')
            ->add('tags')
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

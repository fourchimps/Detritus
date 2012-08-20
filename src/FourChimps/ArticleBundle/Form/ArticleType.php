<?php

namespace FourChimps\ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('headline')
            ->add('body')
            ->add('slug')
            ->add('intro')
            ->add('created')
            ->add('updated')
            ->add('tags')
            ->add('author')
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

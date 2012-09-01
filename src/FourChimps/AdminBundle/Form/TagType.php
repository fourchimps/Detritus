<?php

namespace FourChimps\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tag')
            ->add('navigable')
            ->add('articles')
            ->add('tagGroup')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FourChimps\ArticleBundle\Entity\Tag'
        ));
    }

    public function getName()
    {
        return 'fourchimps_adminbundle_tagtype';
    }
}

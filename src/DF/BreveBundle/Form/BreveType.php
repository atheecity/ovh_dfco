<?php

namespace DF\BreveBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BreveType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Titre'))
            ->add('categorie', 'entity', array(
            	'class' => 'DFBreveBundle:Categorie',
            	'property' => 'libelle', 
            	'multiple' => false
        	))
            ->add('illustration',  'textarea', array('attr' => array('class' => 'ckeditor-illustration')))
            ->add('content', 'textarea', array('attr' => array('class' => 'ckeditor')));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DF\BreveBundle\Entity\Breve'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'df_brevebundle_brevetype';
    }
}

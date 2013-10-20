<?php

namespace DF\MatchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatchsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'datetime', array(
            	'date_widget' => 'single_text',
            	'time_widget' => 'single_text',
            	'required' => false,
        	))
            ->add('scoreDom', 'text', array(
            	'label' => 'Score équipe domicile',
            	'required' => false,
            ))
            ->add('scoreExt', 'text', array(
            	'label' => 'Socre équipe extérieur',
            	'required' => false,
        	))
            ->add('scoreDomTab')
            ->add('scoreExtTab')
            ->add('prolongation')
            ->add('report')
            ->add('dateReport', 'date', array(
            	'widget' => 'single_text',
            	'required' => false,
        	))
            ->add('stade', 'entity', array(
            	'class' => 'DFStadeBundle:Stade',
            	'property' => 'nom',
            	'required' => false,
        	))
		;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DF\MatchBundle\Entity\Matchs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'df_matchbundle_matchstype';
    }
}

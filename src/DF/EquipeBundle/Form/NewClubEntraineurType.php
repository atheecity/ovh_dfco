<?php

namespace DF\EquipeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewClubEntraineurType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('club', 'entity', array(
            	'class' => 'DFEquipeBundle:Club', 
            	'property' => 'nom',
        	))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DF\EquipeBundle\Entity\ClubEntraineur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'df_equipebundle_newclubentraineur';
    }
}

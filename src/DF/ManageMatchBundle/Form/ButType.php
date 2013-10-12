<?php

namespace DF\ManageMatchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ButType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$joueurs = function (EntityRepository $er) use ($options) {
    		return $er->createQueryBuilder('j')
    		->join('DF\JoueurBundle\Entity\JoueurClub', 'jc')
    		->where('jc.joueur = j.id')
    		->andWhere('jc.club = :club')
    		->setParameter('club' ,$options['club']);
    	};
    	
        $builder
	        ->add('joueur', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('minute')
            ->add('csc', 'checkbox', array(
            	'required' => false
	        ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    	$resolver->setRequired(array(
    			'club'
    	));
    	
    	$resolver->setDefaults(array(
            'data_class' => 'DF\ManageMatchBundle\Entity\But'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'df_managematchbundle_but';
    }
}

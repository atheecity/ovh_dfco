<?php

namespace DF\ManageMatchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CompositionType extends AbstractType
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
            ->add('joueur1', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur2', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur3', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur4', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur5', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur6', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur7', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur8', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur9', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur10', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ))
            ->add('joueur11', 'entity', array(
            	'class' => 'DFJoueurBundle:Joueur', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $joueurs
             ));
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
            'data_class' => 'DF\ManageMatchBundle\Entity\Composition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'df_managematchbundle_compositiontype';
    }
}

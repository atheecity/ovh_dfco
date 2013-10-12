<?php

namespace DF\ManageMatchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupeType extends AbstractType
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
            ->add('joueurs')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DF\ManageMatchBundle\Entity\Groupe'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'df_managematchbundle_groupe';
    }
}

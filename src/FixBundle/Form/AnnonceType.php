<?php

namespace FixBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
            ->add('description')
            ->add('etat', ChoiceType::class,array('choices'=>array('valide'=>"valide",
                'en cour'=>"en cour",
                'terminer'=>"terminer",
                'annuler'=>"annuler",),))
            ->add('dateDebut')
            ->add('dateFin')
            ->add('lieu')
            ->add('souscategorie')
            ->add('souscategorie', EntityType::class,array('class'=>'FixBundle:souscategorie','choice_label'=>'titre','multiple'=>false))
            ->add('save',SubmitType::class);}

            /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FixBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fixbundle_annonce';
    }


}

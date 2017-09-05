<?php

namespace MP\CompBundle\Form;
use MP\CompBundle\Entity\Niveau;
use MP\CompBundle\Form\NiveauType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('bon')
            ->add('temps')            
            ->add('niveau', EntityType::class, array(
                'class'        => 'MPCompBundle:Niveau',
                'choice_label' => 'name',
                'multiple'     => true,
              ))
            ->add('save',      SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MP\CompBundle\Entity\Comp'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mp_compbundle_comp';
    }


}

<?php

namespace MP\CompBundle\Form;
use MP\CompBundle\Entity\Niveau;
use MP\CompBundle\Form\NiveauType;
use MP\CompBundle\Entity\Category;
use MP\CompBundle\Form\CategoryType;
use MP\CompBundle\Entity\Materiel;
use MP\CompBundle\Form\MaterielType;
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
            ->add('description')
            ->add('bon')
            ->add('temps')
            ->add('categories', EntityType::class, array(
                'class'        => 'MPCompBundle:Category',
                'choice_label' => 'name',
                'multiple'     => true,
              ))
            ->add('niveau', EntityType::class, array(
                'class'        => 'MPCompBundle:Niveau',
                'choice_label' => 'name',
                'multiple'     => true,
              ))
            
            ->add('matos',  MaterielType::class)
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

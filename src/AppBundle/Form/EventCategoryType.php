<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventCategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','Symfony\Component\Form\Extension\Core\Type\TextType',array(
            "label" => false,
            "attr" => array(
                "placeholder" => "eventCategory.name"
            )
        ))
            ->add('color','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                "label" => false,
                "attr" => array(
                    "placeholder" => "eventCategory.color"
                )
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EventCategory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_eventcategory';
    }


}

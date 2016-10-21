<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('description','Symfony\Component\Form\Extension\Core\Type\TextareaType')
            ->add('dateStart','Symfony\Component\Form\Extension\Core\Type\DateTimeType')
            ->add('dateEnd','Symfony\Component\Form\Extension\Core\Type\DateTimeType')
            ->add('category','Symfony\Bridge\Doctrine\Form\Type\EntityType',array(
                'class' => 'AppBundle\Entity\EventCategory',
                'choice_label' => 'name'
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}

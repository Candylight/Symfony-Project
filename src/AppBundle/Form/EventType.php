<?php

namespace AppBundle\Form;

use AppBundle\Entity\Event;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\EventCategory;

class EventType extends AbstractType
{
    private $user;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->user = $options['user'];

        $builder
            ->add('title',TextType::class,array(
                "label" => "event.create.title"
            ))
            ->add('description',TextareaType::class,array(
                "label" => "event.create.description"
            ))
            ->add('dateStart',DateTimeType::class,array(
                "label" => "event.create.dateStart"
            ))
            ->add('dateEnd',DateTimeType::class,array(
                "label" => "event.create.dateEnd"
            ))
            ->add('category',EntityType::class,array(
                "label" => "event.create.category",
                'class' => EventCategory::class,
                'choice_label' => 'name'
            ));

        if(count($this->user->getFriends()) > 0)
        {
            $builder->add('participant',EntityType::class,array(
                "label" => "event.create.participant",
                'class' => User::class,
                'choice_label' => 'username',
                'multiple' => true,
                'expanded' => true,
                'choices' => $this->user->getFriends(),
                'attr' => array(
                    'class' => 'chooseFriendContainer'
                )
            ));
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event',
            'user' => null,
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

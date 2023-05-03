<?php

namespace App\Form;

use App\Entity\EventPlanningConference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventPlanningConferenceType extends EventPlanningType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
	    parent::buildForm($builder, $options);
	    $builder
            ->add('speaker')
        ;

	    $builder->add('_type', HiddenType::class, array(
		    'data'   => 'type_conference', // Arbitrary, but must be distinct
		    'mapped' => false
	    ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventPlanningConference::class,
        ]);
    }

	public function getBlockPrefix(): string
	{
		return 'conference';
	}
}

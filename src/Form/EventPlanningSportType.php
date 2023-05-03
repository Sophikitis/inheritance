<?php

namespace App\Form;

use App\Entity\EventPlanning;
use App\Entity\EventPlanningSport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventPlanningSportType extends EventPlanningType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

		parent::buildForm($builder, $options);
        $builder
            ->add('opponentTeamName')
            ->add('OpponentTeamLogo')


        ;

	    $builder->add('_type', HiddenType::class, array(
		    'data'   => 'type_sport', // Arbitrary, but must be distinct
		    'mapped' => false
	    ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventPlanningSport::class,
        ]);
    }

	public function getBlockPrefix(): string
	{
		return 'sport';
	}
}

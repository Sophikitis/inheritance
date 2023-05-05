<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\EventPlanning;
use App\Entity\EventPlanningConference;
use App\Entity\EventPlanningSport;
use Infinite\FormBundle\Form\Type\PolyCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')

	        ->add('type', ChoiceType::class, [
		        'choices' => [
			        'Conference' => 'conference',
			        'Sport' => 'sport',
		        ],
	        ])
	        ->add('eventsPlanning', PolyCollectionType::class,
	        [
				'types' => [EventPlanningSportType::class, EventPlanningConferenceType::class],
		        'types_options' => array(
			        EventPlanningSportType::class => array(
				        // Here you can optionally define options for the InvoiceLineType
			        ),
			        EventPlanningConferenceType::class => array(
				        // Here you can optionally define options for the InvoiceProductLineType
			        )
		        ),
		        'allow_add' => true,
		        'allow_delete' => true,
		        'data' =>  [ new EventPlanningSport()]
	        ])
	        ->add('submit', SubmitType::class, ['label' => 'Create'])
        ;

//
//	    $builder->addEventListener(
//		    FormEvents::PRE_SET_DATA,
//		    function (FormEvent $event) {
//			    $form = $event->getForm();
//			    $form->add('eventsPlanning', CollectionType::class, [
//				    'entry_type' => EventPlanningSportType::class,
//				    'label' => false,
//				    'by_reference' => false,
//				    'allow_add' => true,
//				    'allow_delete' => true,
//				    'data' => [
//					    new EventPlanningSport()
//				    ]
//			    ]);
//		    }
//	    );

//	    $builder->get('eventsPlanning')
//		    ->addModelTransformer(new CallbackTransformer(
//			    function ($tagsAsArray): array {
//				    return [
//						new EventPlanningSport()
//				    ];
//			    },
//			    function ($tagsAsString): array {
//				    return $tagsAsString;
//			    }
//		    ))
//	    ;

//	    $builder->get('type')->addEventListener(
//		    FormEvents::POST_SUBMIT,
//		    function (FormEvent $event) {
//			    // It's important here to fetch $event->getForm()->getData(), as
//			    // $event->getData() will get you the client data (that is, the ID)
//			    $type = $event->getForm()->getData();
//				$form = $event->getForm()->getParent();
//
////				$form->remove('eventsPlanning');
//
//			    if ($type === 'sport'){
//				    $form->add('eventsPlanning', CollectionType::class, [
//					    'entry_type' => EventPlanningSportType::class,
//					    'label' => false,
//					    'by_reference' => false,
//					    'allow_add' => true,
//					    'allow_delete' => true,
//					    'data' => [
//						    new EventPlanningSport()
//					    ]
//				    ]);
//			    }else{
//				    $form->add('eventsPlanning', CollectionType::class, [
//					    'entry_type' => EventPlanningConferenceType::class,
//					    'label' => false,
//					    'by_reference' => false,
//					    'allow_add' => true,
//					    'allow_delete' => true,
//					    'data' => [
//						    new EventPlanningConference()
//					    ]
//				    ]);
//			    }
//
//		    });


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
//	        'csrf_protection' => false,
        ]);
    }
}

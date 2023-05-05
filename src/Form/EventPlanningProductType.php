<?php

namespace App\Form;

use App\Entity\EventPlanningProduct;
use App\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventPlanningProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('quantity')
	        ->add('category', ChoiceType::class, [
				'choices' => [
			        'food' => 'food',
			        'drink' => 'drink',
			        'material' => 'material',
		        ],
		        'mapped' => false,
	        ])
//            ->add('product', EntityType::class, [
//				'class' => Products::class,
//				'choice_label' => 'label',
//			])
        ;

	    $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
		    $product = $event->getData();
		    $form = $event->getForm();

			$form->add('product', EntityType::class, [
				'class' => Products::class,
				'choice_label' => 'label',
				'query_builder' => function ($er) use ($product) {
					return $er->createQueryBuilder('p')
						->where('p.id = :category')
						->setParameter('category', 1);
				},
			]);
	    });

	    $builder->get('category')->addEventListener(
		    FormEvents::POST_SUBMIT,
		    function (FormEvent $event){
			    // It's important here to fetch $event->getForm()->getData(), as
			    // $event->getData() will get you the client data (that is, the ID)
			    $sport = $event->getForm()->getData();
				$form =$event->getForm()->getParent();

				if ($sport == 'drink') {
					$form->add('product', EntityType::class, [
						'class' => Products::class,
						'choice_label' => 'label',
						'query_builder' => function ($er) {
							return $er->createQueryBuilder('p')
								->where('p.id = :category')
								->setParameter('category', 5);
						},
					]);
				}
		    }
	    );




    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventPlanningProduct::class,
        ]);
    }
}

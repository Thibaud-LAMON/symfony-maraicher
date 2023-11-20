<?php

/**
 *Formulaire de création de commande
 */

namespace App\Form;

use App\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CreateOrderForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre nom',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse email',
                'required' => true,
            ])
            ->add('phone', TextType::class, [
                'label' => 'votre numéro de téléphone',
                'required' => true,
            ]);;
        foreach ($options['products'] as $product) {
            $builder->add('product_' . $product->getId(), NumberType::class, [
                // Options du champ
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
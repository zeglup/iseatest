<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', null, ['label' => 'Activé' ])
            ->add('gender', null, ['label' => 'Civilité' ])
            ->add('forname', null, ['label' => 'Prénom' ])
            ->add('surname', null, ['label' => 'Nom' ])
            ->add('street', null, ['label' => 'Adresse' ])
            ->add('zipcode', null, ['label' => 'Code postal' ])
            ->add('city', null, ['label' => 'Ville' ])
            ->add('country', null, ['label' => 'Pays' ])
            ->add('birthdate', DateTimeType::class, ['label' => 'Date de naissance'])
            ->add('loyaltyCardNumber', null, ['label' => 'Numéro de carte fidélité' ])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer' ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}

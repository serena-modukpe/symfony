<?php

namespace App\Form;

use App\Entity\RolesHabilitations;
use App\Entity\Roles;
use App\Entity\Habilitations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType as TypeEntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RolesHabilitationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('role', TypeEntityType::class, [
            'class' => Roles::class,
            'choice_label' => 'libelle',
            'choice_value' => 'id',
            'placeholder' => 'Selectionnez un rôle',
        ])
        ->add('habilitation', TypeEntityType::class, [
            'class' => Habilitations::class,
            'choice_label' => 'libelle',
            'choice_value' => 'id',
            'placeholder' => 'Selectionnez une habilitation',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RolesHabilitations::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Roles;
use App\Entity\RolesHabilitations;
use App\Entity\User;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('user', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'nom', // Assuming 'username' is the field you want to display
            'placeholder' => 'Select un user',
        ])
        ->add('role', EntityType::class, [
            'class' => Roles::class,
            'choice_label' => 'libelle', // Assuming 'libelle' is the field you want to display
            'placeholder' => 'Select un rôle',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}

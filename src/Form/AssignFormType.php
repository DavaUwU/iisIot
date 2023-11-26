<?php

namespace App\Form;

use App\Entity\System;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssignFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('system', EntityType::class, [
                'class' => System::class,
                'choice_label' => 'name',
                'label' => 'Select System',
                'placeholder' => 'Choose a system',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // If you're not editing a System entity directly, you might not need this line:
            // 'data_class' => System::class,
        ]);
    }
}

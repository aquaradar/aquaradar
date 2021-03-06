<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotificationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('address', TextType::class, [
                    'label' => 'Endereço',
                ])
                ->add('latitude', HiddenType::class)
                ->add('longitude', HiddenType::class)
                ->add('type', ChoiceType::class, [
                    'choices' => ['Vazamento' => 0, 'Falta de Água' => 1],
                    'label' => 'Tipo',
                ])
                ->add('send', SubmitType::class, [
                    'label' => 'Enviar',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
                // Configure your form options here
        ]);
    }

}

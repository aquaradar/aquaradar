<?php

namespace App\Form;

use App\Entity\Tank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TankType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, [
                    'label' => 'Nome',
                ])
                ->add('address', TextType::class, [
                    'label' => 'Endereço',
                ])
                ->add('latitude', HiddenType::class, [
                    'label' => 'Latitude',
                ])
                ->add('longitude', HiddenType::class, [
                    'label' => 'Longitude',
                ])
                ->add('level', IntegerType::class, [
                    'label' => 'Nível',
                ])
                ->add('send', SubmitType::class, [
                    'label' => 'Enviar',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Tank::class,
        ]);
    }

}

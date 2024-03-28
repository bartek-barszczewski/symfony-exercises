<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LocationSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('input_search', TextType::class, [
                'mapped' => false,
                'label' => false,
                'row_attr' => ['class' => 'text-editor', 'id' => 'input-city__search', 'label' => ''],
                'attr' => ['placeholder' => 'Type city'],
            ] )
        ;
    }
}

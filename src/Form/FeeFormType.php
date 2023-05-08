<?php

namespace App\Form;

use App\Entity\Fee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class FeeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('span', ChoiceType::class, [
                'choices'  => [
                    '12' => 12,
                    '24' => 24,
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('amount', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Range(
                        min: 1000,
                        max: 20000,
                        notInRangeMessage: 'Your loan has to be between {{ min }} PLN and {{ max }} PLN',
                    )
                ],])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fee::class,
        ]);
    }
}
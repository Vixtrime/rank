<?php

namespace App\API\DataForSeoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Fixtures\ChoiceSubType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DataForSeoRankFormType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('se', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 128])
                ]
            ])
            ->add('loc', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('key', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('site', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 128])
                ]
            ]);
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true,
//            'data_class' => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'userGeneral',
        ]);
    }
}
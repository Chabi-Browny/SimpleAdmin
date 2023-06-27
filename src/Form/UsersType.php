<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new Length([
                            'min' => 3,
                            'minMessage' => 'Túl kevés karakter! Legalább {{ limit }} hosszú legyen a név.',
                            'max' => 150,
                            'maxMessage' => 'Túl sok karakter! Legfeljebb {{ limit }} hosszú lehet a név.',
                        ]),
//                        new UniqueEntity([
//                            'fields' => ['username'],
//                            'message' => 'Ez a felhasználó már létezik: {{ value }}'
//                        ])
                    ],
                ]
            )
            ->add('password', PasswordType::class, [
                    'required' => true,
                    'constraints' => [
                        new Length([
                            'min' => 5,
                            'minMessage' => 'Túl kevés karakter! Legalább {{ limit }} hosszú legyen a jelszó.',
                        ])
                    ]
                ]
            )
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => $options['data']->getRoles(),
        ]);

        $builder->get('roles')->addModelTransformer( new CallbackTransformer(
            function($rolesAsArray): string
            {
                return implode(', ', $rolesAsArray);
            },
            function($rolesAsString): array
            {
                return explode(', ', $rolesAsString);
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }

}
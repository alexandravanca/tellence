<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName')
                ->add('lastName')
                ->add('email', EmailType::class)
                ->add('sex',ChoiceType::class, array(
                            'choices' => array(
                                'Male' => 'm',
                                'Female' => 'f',
                                'Not specified' => 'n',
                            )))
                ->add('agreeTerms', CheckboxType::class, array('mapped' => false))
                ->add('submit', SubmitType::class);
    }


}
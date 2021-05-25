<?php

namespace App\Form;

use App\Entity\Expense;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ExpenseType
 * @package App\Form
 */
class ExpenseType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('description', TextType::class, ['label'=> 'description'])
			->add('value', TextType::class, ['label' => 'value'])
		;
	}

	/**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
            'csrf_protection' => false,
        ]);
	}
    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return '';
    }
}

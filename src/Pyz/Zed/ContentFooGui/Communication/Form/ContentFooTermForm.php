<?php
namespace Pyz\Zed\ContentFooGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
// new added bcz not found in doc
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;


class ContentFooTermForm extends AbstractType
{
    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'foo';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'label' => 'Name',
        ]);

        $builder->add('city', TextType::class, [
            'label' => 'City',
        ]);

        $builder->add('address', TextType::class, [
            'label' => 'Address',
        ]);

        $builder->add('numberOfEmployees', IntegerType::class, [
            'label' => 'Number of employees',
        ]);
    }

    /**
     * User this method if you need to provide custom template path or additional data to template
     *
     * @param \Symfony\Component\Form\FormView $view
     * @param \Symfony\Component\Form\FormInterface $form
     * @param array $options
     *
     * @return void
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['attr']['template_path'] = '@ContentFooGui/_includes/foo_form.twig';
    }
}
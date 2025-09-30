<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use App\Entity\Product;
use App\Entity\subCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('stock')
            ->add('image',FileType::class,[
                'label'=>'Image du produit :',
                'mapped'=> false,
                'required'=>false,
                'constraints'=>[
                    new File([
                        "maxSize"=>"1024k",
                        'extensions'=>['jpg','png','jpeg'],
                        'extensionsMessage'=>'Votre image doit être dans un format valide (.jpg, .png, .jpeg) !',
                        'maxSizeMessage'=>'Votre image doit faire moins de 1024k !'
                    ])
                ]
            ])
            ->add('SubCategories', EntityType::class, [
                'class' => SubCategory::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

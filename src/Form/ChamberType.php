<?php

namespace App\Form;

use App\Entity\Chamber;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ChamberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description', CKEditorType::class)
            ->add('price', MoneyType::class)
            ->add('imageFile', VichFileType::class,  [
                    'required' => false,
                    'label_format' => "File",
                    'label' => "File",
                    'download_link' => true,
                    'allow_delete' => false,
                    'asset_helper' => true,
                    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chamber::class,
        ]);
    }
}

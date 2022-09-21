<?php

namespace App\Controller\Admin;

use App\Entity\Chamber;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ChamberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chamber::class;
    }


/*    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ;
    }*/

    public function configureFields(string $pageName): iterable
    {
        $filename = ImageField::new('imageName', 'Afbeelding')
            ->setBasePath('uploads/images/chambers')
            ->setUploadDir('public/uploads/images/chambers')
            ->setRequired(false)
            ->setFormTypeOptions(
                [
                    'required' => false,
                ]
            );

        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            $filename,
        ];
    }

}

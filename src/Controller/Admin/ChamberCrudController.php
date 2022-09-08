<?php

namespace App\Controller\Admin;

use App\Entity\Chamber;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChamberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chamber::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

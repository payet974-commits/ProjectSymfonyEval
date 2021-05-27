<?php

namespace App\Controller\Admin;

use App\Entity\Actor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ActorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actor::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('firstName'),
            TextField::new('lastName'),
            ImageField::new('image')->setUploadDir("/public/assets/upload/images")
            ->setBasePath("assets/upload/images")
        ];
    }
    
}

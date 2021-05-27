<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;



class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('originalName'),
            TextEditorField::new('synopsis'),
            DateTimeField::new('releaseDate'),
            TextField::new('actors'),
            TextField::new('genres'),
            BooleanField::new('seen'),
            BooleanField::new('watchList'),
            
            AssociationField::new('actor'),
            AssociationField::new('genre'),
            AssociationField::new('studio'),
            ImageField::new('image')->setUploadDir("/public/assets/upload/images")
                                    ->setBasePath("assets/upload/images")
                                    
  ];  
  
    }
}

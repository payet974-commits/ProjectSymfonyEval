<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Entity\Genre;
use App\Entity\Studio;
use App\Entity\Actor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MyMovieDb');
    }

    public function configureMenuItems(): iterable
    {
        return[
        MenuItem::linkToCrud('Movies', 'fa fa-tags', Movie::class),
        MenuItem::linkToCrud('Genres', 'fa fa-tags', Genre::class),
        MenuItem::linkToCrud('Studios', 'fa fa-tags', Studio::class),
        MenuItem::linkToCrud('Actors', 'fa fa-tags', Actor::class),

        ];
    
    }

}

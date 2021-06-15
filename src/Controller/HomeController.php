<?php

namespace App\Controller;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Actor;
use App\Entity\Studio;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ActorRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Repository\StudioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HomeController extends AbstractController
{
    private $repoMovie;

    public function __construct(MovieRepository $repoMovie){
        $this->repoMovie = $repoMovie;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(GenreRepository $repoGenre, ActorRepository $repoActor, StudioRepository $repoStudio, UserRepository $repoUser): Response
    {
     $movies = $this->repoMovie->findAll();
     $genres = $repoGenre->findAll();
     $actors = $repoActor->findAll();
     $studios = $repoStudio->findAll();
     
     //$users = $repoUser->findAll();
       
        return $this->render("home/index.html.twig",[
            'movies' => $movies,
            'genres' => $genres,
            'actors' => $actors,
            'studios' =>$studios,
           
            
           // 'users'=>$users
        ]);
    }
      /**
     * @Route("/view/{id}", name="view")
     */
    public function view(Movie $movie): Response
    {
        if(!$movie)
            return $this->redirectToRoute('home');
        return $this->render("home/view.html.twig",[
            'movies'=>$movie
            
        ]);
    }
    /**
     * @Route("/showByGenre/{id}", name="showByGenre")
     */
    public function showByGenre(Genre $genre): Response
    {
        if(!$genre)
            return $this->redirectToRoute('home');
        return $this->render("home/index.html.twig",[
            'movies'=>$genre->getMovies(),
        ]);
    }

     /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render("home/about.html.twig");
    } 

      /**
     * @Route("/edit/{id}", name="edit_movie")
     * 
     */
    public function updateMovie (Request $request,$id){
        $movie=$this->getDoctrine()->getRepository(Movie::class);
        $movie = $movie->find($id);

        if(!$movie){
            throw $this->createNotFoundException(
                'There are no movies with the following id: ' . $id
            ); 
        }
        $form = $this->createFormBuilder($movie)
        ->add('name', TextType::class)
        ->add('synopsis', TextareaType::class)
        ->add('seen', CheckboxType::class)
        ->add('save', SubmitType::class, array('label' => 'Sauvegarder'))
        ->getForm();
    $form->handleRequest($request);
    if ($form->isSubmitted()) {
        $em = $this->getDoctrine()->getManager();
        $movie = $form->getData();
        $em->flush();
        return $this->redirect($this->generateUrl('home'));
    }
    return $this->render(
        'home/edit.html.twig',
        array('form' => $form->createView())
    );
}
    

    /**
     * @Route("/DisplayMovieNotSeen/{id}", name="movienotseen")
     */
    public function DisplayMovieNotSeen(MovieRepository $movies): Response
    {
        $movies = $this->repoMovie->findBy(array('seen'=>false));
        
        return $this->render("home/DisplayMovieNotSeen.html.twig",[
            
            'movies'=>$movies
           
        ]);
       
    }

     /**
     * @Route("/DisplayMovieSeen/{id}", name="movieseen")
     */
    public function DisplayMovieSeen(MovieRepository $movies): Response
    {
        $movies = $this->repoMovie->findBy(array('seen'=>true));
        
        return $this->render("home/DisplayMovieSeen.html.twig",[
            
            'movies'=>$movies
           
        ]);
       
    }




}
      


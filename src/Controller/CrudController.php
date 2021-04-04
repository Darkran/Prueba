<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CrudController extends AbstractController
{
    
     /**
     * Muestra los datos de la tabla empresas
     * @Route("/crud/inicio", name="crud_index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('CRUD/inicio.html.twig');
    }
    
    
    
}
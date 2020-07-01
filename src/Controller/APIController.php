<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    /**
     * @Route("/a/p/i", name="a_p_i")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/APIController.php',
        ]);
    }
}

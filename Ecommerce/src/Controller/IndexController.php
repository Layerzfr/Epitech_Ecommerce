<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class IndexController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    /**
     * @Route("/")
     */
    public function numberAction()
    {
        return $this->render('index.html.twig');
    }
}
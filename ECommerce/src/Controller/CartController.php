<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    /**
     * @Route("/addToCart", name="addToCart", methods={"POST"})
     */
    public function addToCart()
    {
        $content = $_POST;

        $session = $this->get('session');

        $cartElements = $session->get('cartElements');
        if(count($cartElements) === 0 ) {
            $session->set('cartElements', array());
        }

        array_push($cartElements, $_POST);
//
        $session->set('cartElements', $cartElements);

        return new JsonResponse(array(
            'success' => true,
        ));
    }
}

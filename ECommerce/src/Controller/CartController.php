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
        $session = $this->get('session');

        $cartElements = $session->get('cartElements');
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cart' => $cartElements,
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
        if (is_array(($cartElements))) {
            if (sizeof($cartElements) === 0) {
                $session->set('cartElements', array());
            }
        } else {
            $cartElements = array();
        }

        array_push($cartElements, $_POST);
//
        $session->set('cartElements', $cartElements);

        return new JsonResponse(array(
            'success' => true,
        ));
    }

    /**
     * @Route("/removeFromCart", name="removeFromCart", methods={"POST"})
     */
    public function removeFromCart()
    {
        $content = $_POST;
        $session = $this->get('session');

        $cartElements = $session->get('cartElements');
        if(count($cartElements) === 0 ) {
            $session->set('cartElements', array());
        }

        foreach($cartElements as $key => $value) {
            if($value['id'] === $content['id']) {
                unset($cartElements[$key]);
            }
        }

        $session->set('cartElements', $cartElements);

        return new JsonResponse(array(
            'success' => $cartElements,
        ));
    }


}

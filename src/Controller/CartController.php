<?php

namespace App\Controller;

use App\Repository\ChamberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(ChamberRepository $chamberRepository): Response
    {
        $session = new Session();
        $session->start();
        $cart = $session->get('cart', []);

        // $cart = array_keys($cart);
        // print_r($cart); die;

        // fetch the information using query and ids in the cart
        if ($cart != '') {


            if (isset($cart)) {
                $product = $chamberRepository->findAll();
                // alle 1000000000000 producten inladen om b.v. max 25 producten te laten zien.   NIET HANDIG TODO
                // misschien kan je hier alleen de producten inlezen die er in deze sessie zijn genoteerd.
            }


            return $this->render('cart/index.html.twig', array(
                'empty' => false,
                'product' => $product,
            ));
        } else {
            return $this->render('cart/index.html.twig', array(
                'empty' => true,
            ));
        }
     }

    #[Route('/add/{id}', name: 'app_cart_add')]
    public function add($id)
    {
        $session = new Session();
        $session->start();
        $cart = $session->get('cart', []);
        $cart['id'] = $id;
        $cart['number'] = $cart['number'] + 1;

        $session->set('cart', $cart);

        // product toevoegen aan session
    }

    #[Route('/remove', name: 'app_cart_remove')]
    public function remove()
    {
        // product verwijderen uit session
    }

    #[Route('/checkout', name: 'app_cart_checkout')]
    public function checkout()
    {
        // uitchecken en in database noteren.
    }

}

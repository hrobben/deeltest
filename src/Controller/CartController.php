<?php

namespace App\Controller;

use App\Repository\ChamberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(ChamberRepository $chamberRepository): Response
    {
        $session = $this->requestStack->getSession();
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
            return $this->render('chamber/index.html.twig', array(
                'empty' => true,
            ));
        }
     }

    #[Route('/add/{id}', name: 'app_cart_add')]
    public function add($id, ChamberRepository $chamberRepository)
    {
        $session = $this->requestStack->getSession();

        $cart = $session->get('cart', []);
        if (isset($cart[$id])) {
            ++$cart[$id];
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        // product toevoegen aan session

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/remove/{id}', name: 'app_cart_remove')]
    public function remove($id)
    {
        // product verwijderen uit session
        $session = $this->requestStack->getSession();

        $cart = $session->get('cart', []);
        // if it doesn't exist redirect to cart index page. end
        if (!$cart[$id]) {
            return $this->redirectToRoute('app_cart');
        }

        // check if the $id already exists in it.
        if (isset($cart[$id])) {
            $cart[$id] = $cart[$id] - 1;
            if ($cart[$id] < 1) {
                unset($cart[$id]);
            }
        } else {
            return $this->redirectToRoute('app_cart');
        }

        $session->set('cart', $cart);

        //echo('<pre>');
        //print_r($cart); echo ('</pre>');die();        $session->set('cart', $cart);

        // product toevoegen aan session

        return $this->redirectToRoute('app_cart');

    }

    #[Route('/checkout', name: 'app_cart_checkout')]
    public function checkout()
    {
        // uitchecken en in database noteren.
    }

}

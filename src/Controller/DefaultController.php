<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DefaultController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }

    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        if ($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->render('default/index.html.twig', [
                'controller_name' => 'MBO RIJNLAND Zoetermeer',
                'name' => 'System Noreply',
            ]);
        }
        return $this->redirectToRoute('app_login');
    }
}

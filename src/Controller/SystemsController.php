<?php

namespace App\Controller;

use App\Repository\SystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class SystemsController extends AbstractController
{

    #[Route('/systems', name: 'app_systems')]
    public function index(SystemRepository $systemRepository, UserInterface $user = null): Response
    {

        $systems = $systemRepository->findBy(['Owner' => $user]);

        return $this->render('systems/index.html.twig', [
            'systems' => $systems,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\System;
use App\Form\DeviceAssignFormType;
use App\Form\SystemFormType;
use App\Repository\AccountRepository;
use App\Repository\SystemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class SystemsController extends AbstractController
{
    private $em;
    private $systemRepository;
    private $accountRepository;

    public function __construct(SystemRepository $systemRepository, AccountRepository $accountRepository,
                                EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->systemRepository = $systemRepository;
        $this->accountRepository = $accountRepository;
    }

    #[Route('/systems', name: 'app_systems')]
    public function index(UserInterface $user): Response
    {

        $systems = $this->systemRepository->findBy(['Owner' => $user]);

        return $this->render('systems/index.html.twig', [
            'systems' => $systems,
        ]);
    }

    #[Route('/systems/create', name: 'create_system')]
    public function create(Request $request, UserInterface $user): Response
    {
        $system = new System();
        $form = $this->createForm(SystemFormType::class, $system);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $system->setOwner($this->accountRepository->find($user));

            $this->em->persist($system);
            $this->em->flush();

            return $this->redirectToRoute('app_systems');
        }

        return $this->render('systems/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/systems/delete/{id}', name: 'delete_system', methods: ['GET', 'DELETE'])]
    public function delete($id): Response
    {
        $system = $this->systemRepository->find($id);
        $this->em->remove($system);
        $this->em->flush();

        return  $this->redirectToRoute('app_systems');
    }
}

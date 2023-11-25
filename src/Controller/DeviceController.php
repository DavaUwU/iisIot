<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceFormType;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\DeviceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DeviceController extends AbstractController
{
    private $deviceRepository;
    private $em;
    private $accountRepository;

    public function __construct(DeviceRepository $deviceRepository, AccountRepository $accountRepository,
                                EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->deviceRepository = $deviceRepository;
        $this->accountRepository = $accountRepository;
    }

    #[Route('/device', name: 'app_device')]
    public function index(UserInterface $user): Response
    {
        $devices = $this->deviceRepository->findBy(['owner' => $user]);


        return $this->render('device/index.html.twig', [
            'devices' => $devices,
        ]);
    }

    #[Route('/device/create', name: 'create_device')]
    public function create(Request $request, UserInterface $user): Response
    {
        $device = new Device();
        $form = $this->createForm(DeviceFormType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $device->setOwner($this->accountRepository->findOneBy(['username' => $user->getUserIdentifier()]));

            $this->em->persist($device);
            $this->em->flush();

            return $this->redirectToRoute('app_device');
        }

        return $this->render('device/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/device/delete/{id}', name: 'delete_device', methods: ['GET', 'DELETE'])]
    public function delete($id): Response
    {
        $device = $this->deviceRepository->find($id);
        $this->em->remove($device);
        $this->em->flush();

        return  $this->redirectToRoute('app_device');
    }
}

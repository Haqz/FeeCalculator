<?php
namespace App\Controller;

use App\Form\FeeFormType;
use App\Service\AppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController extends AbstractController
{
    #[Route('/')]
    public function index(Request $request, AppService $appService): Response
    {
        $form = $this->createForm(FeeFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('base.html.twig', [
                'form' => $form->createView(),
                'amount' => $appService->calculate($form->get('amount')->getData(), $form->get('span')->getData())
            ]);
        }

        return $this->render('base.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @Route("/")
     */
    public function index(Request $request) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Thank you!'
            );
            return $this->redirectToRoute('app_main_index');
        }

        return $this->render('home/collect.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/show")
     */
    public function show(Request $request) {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')->findAll();

        return $this->render('home/show.html.twig',[
            'users' => $users,
        ]);
    }
}
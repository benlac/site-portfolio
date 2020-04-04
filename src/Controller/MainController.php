<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }
    /**
     * @Route("/competences", name="main_skill")
     */
    public function skill()
    {
        return $this->render('main/skill.html.twig');
    }
    /**
     * @Route("/portfolio", name="main_portfolio")
     */
    public function portfolio()
    {
        return $this->render('main/portfolio.html.twig');
    }
    /**
     * @Route("/contact", name="main_contact")
     */
    public function contact(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('succes', 'Votre email a bien été transmis');
        }
        return $this->render('main/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

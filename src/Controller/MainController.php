<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            $this->addFlash('success', 'Votre email a bien été transmis');
            return $this->redirectToRoute('main_contact');
        }
        return $this->render('main/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/download", name="main_download")
     */
    public function download()
    {
        $file = new File('assets/files/benoitLacombled-cv.pdf');

        return $this->file($file, 'cv-benoitLacombled.pdf', ResponseHeaderBag::DISPOSITION_ATTACHMENT);
    }
}

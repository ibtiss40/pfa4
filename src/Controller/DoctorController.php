<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SecretaireRepository;
use App\Entity\Fichier;
use App\Entity\User;
use App\Entity\RendezVous;
use App\Entity\Secretaire;
use App\Repository\UserRepository;
use App\Repository\RendezVousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;



class DoctorController extends AbstractController
{
    /**
     * @Route("/doctor", name="doctor")
     */
    public function index(): Response
    {
        return $this->render('doctor/index.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
     /**
     * @Route("/addsecretaire", name="addsecretaire")
     */
    public function addsecretaire(): Response
    {
       
        return $this->render('doctor/add-secretaire.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
    /**
     * @Route("/addpatient", name="addpatient")
     */
    public function addpatient(): Response
    {
        return $this->render('doctor/add-patient.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
     /**
     * @Route("/allpatient", name="allpatient")
     */
    public function allpatient(UserRepository $repo): Response
    {
        return $this->render('doctor/patients.html.twig', [
            'user' => $repo->findAll(),
            'controller_name' => 'DoctorController',
        ]);
    }
    /**
     * @Route("/schedule", name="schedule")
     *  @Route("/", name="schedule")
     */
    public function allRv(RendezVousRepository $repo): Response
    {
        return $this->render('doctor/doctor-schedule.html.twig', [
            'Rv' => $repo->findAll(),
            'controller_name' => 'DoctorController',
        ]);
    }
  
     /**
     * @Route("/payments", name="payments")
     */
    public function payments(): Response
    {
        return $this->render('doctor/payments.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
    /**
     * @Route("/mailinbox", name="mailinbox")
     */
    public function mailinbox(): Response
    {
        return $this->render('doctor/mail-inbox.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
    
    /**
     * @Route("/book", name="book")
     */
    public function book(): Response
    {
        return $this->render('doctor/book-appointment.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
    /**
     * @Route("/secretaires", name="secretaires")
     */
    public function secretaires(SecretaireRepository $repo): Response
    {
        return $this->render('doctor/secretaires.html.twig', [
            'secretaire' => $repo->findAll(),
            'controller_name' => 'DoctorController',
        ]);
    }
    
    
    /**
     * @Route("/profileS", name="profiles")
     */
    public function profileS(): Response
    {
        return $this->render('doctor/profile.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
    

     /**
     * @Route("/secretaires/{id}/show", name="pro")
     * @return response
     */
    public function pro($id = null): Response
    {
        $secretaire = $this->getDoctrine()
        ->getRepository(Secretaire::class)
        ->find($id);
        return $this->render('doctor/profile.html.twig', [
            'secretaire' => $secretaire,
        ]);
    }

      /**
     * @Route("/invoice", name="invoice")
     */
    public function invoice(): Response
    {
        return $this->render('doctor/patient-invoice.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
     /**
     * @Route("/addpayments", name="addpayments")
     */
    public function addpayments(): Response
    {
        return $this->render('doctor/add-payments.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
     /**
     * @Route("/reports", name="reports")
     */
    public function reports(): Response
    {
        return $this->render('doctor/reports.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
    /**
     * @Route("/widgets", name="widgets")
     */
    public function widgets(): Response
    {
        return $this->render('doctor/widgets.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
    /**
     * @Route("/modals", name="modals")
     */
    public function modals(): Response
    {
        return $this->render('doctor/modals.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
     /**
     * @Route("/sing", name="sing")
     */
    public function sing(): Response
    {
        return $this->render('doctor/sign-up.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }

    // suppresion
     /**
     * @Route("/secretaires/{id}/delete", name="deleteS")
     */
    public function deleteS(Secretaire $secretaire , EntityManagerInterface $manager)
    {
        $manager->remove($secretaire);
        $manager ->flush();
        return $this->redirectToRoute('secretaires');

    }
     /**
     * @Route("/patients/{id}/delete", name="deleteP")
     */
    public function deleteP(User $user , EntityManagerInterface $manager)
    {
        $manager->remove($user);
        $manager ->flush();
        return $this->redirectToRoute('allpatient');

    }
    
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SecretaireRepository;
use App\Repository\UserRepository;
use App\Repository\FichierRepository;
use App\Entity\Secretaire;
use App\Entity\Fichier;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class CrudControlleurController extends AbstractController
{
    /**
     * @Route("/addFichie/{id}", name="addFichie")
     */
    public function addFichie(Request $request, EntityManagerInterface $manager , $id = null): Response
    {
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($id);


        $fichier= new Fichier();
        $rep = $this->getDoctrine()->getRepository(Fichier::class);
        $repUs = $this->getDoctrine()->getRepository(User::class);
        
        $fichs = $this->getDoctrine()
        ->getRepository(Fichier::class)
        ->findOneBy(array('user'=>$user));


       if($request->files->get("image") != null){
        $file = md5(uniqid()).'.'.$request->files->get('image')->getClientOriginalExtension();
        $request->files->get('image')->move(
            $this->getParameter('images_directory'),
            $file
        );
        $fichier->setUrl('/files_telecharger/'.$file);}
        $fichier->setUser($user);
            $manager->persist($fichier);
            $manager->flush();
           // return $this->redirect($request->getRequestUri());
           return $this->render('doctor/patient-profile.html.twig', [
            'fichs' => $fichs,
            'user' => $user,
        ]);
    }
     /**
     * @Route("/profile/show/{id}", name="profile")
     */
    public function profile($id = null): Response
    {  
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($id);

        $fichs = $this->getDoctrine()
        ->getRepository(Fichier::class)
        ->findOneBy(array('user'=>$user));
      //  (['user'=>$request->request->get('user')]);
    




        return $this->render('doctor/patient-profile.html.twig', [
              'fichs' => $fichs,
            'user' => $user,
          
             
        ]);
    }
  
    
    /**
     * @Route("/addS", name="addS")
     */
    public function addS(Request $request, EntityManagerInterface $manager): Response
    {
        $secretaire= new Secretaire();
        $repo = $this->getDoctrine()->getRepository(Secretaire::class);
       $secretaire->setNom($request->request->get("Nom"));
       $secretaire->setPrenom($request->request->get("Prenom"));
       $secretaire->setAdress($request->request->get("Adress"));
       $secretaire->setDateNaissance($request->request->get("Date_naissance"));
       $secretaire->setEmail($request->request->get("Email"));
       $secretaire->setPassword($request->request->get("password"));
       $secretaire->setTelephone($request->request->get("Telephone"));

            $manager->persist($secretaire);
            $manager->flush();
            return $this->redirectToRoute('secretaires');
    }
    /**
     * @Route("/addP", name="addP")
     */
    public function addP(Request $request, EntityManagerInterface $manager): Response
    {
        $user= new User();
        $repo = $this->getDoctrine()->getRepository(User::class);
       $user->setNom($request->request->get("nom"));
       $user->setPrenom($request->request->get("prenom"));
       $user->setVille($request->request->get("ville"));
       $user->setEmail($request->request->get("email"));
       $user->setPassword($request->request->get("password"));
       $user->setTelephone($request->request->get("telephone"));
       $user->setCouvSociale($request->request->get("couvsociale"));
       $user->setProfession($request->request->get("profession"));
       $user->setCin($request->request->get("cin"));
       $user->setGenre($request->request->get("genre"));
       $user->setAge($request->request->get("age"));

       if($request->files->get("image") != null){
        $file = md5(uniqid()).'.'.$request->files->get('image')->getClientOriginalExtension();
        $request->files->get('image')->move(
            $this->getParameter('images_directory'),
            $file
        );
        $user->setImage('/files_telecharger/'.$file);
    }
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('allpatient');
    }
 /**
     * @Route("/test/mail", name="test_mail")
     */
    public function send(Request $request, \Swift_Mailer $mailer, 
        LoggerInterface $logger)
    {
        $name = $request->request->get("message");
//dd($name);
        $message = new \Swift_Message('validation RendezVous');
        $message->setFrom('basmamanel123@gmail.com');
        $message->setTo('ibtissam.rami00@gmail.com');
        $message->setBody( $name
        );

        $mailer->send($message);

        $logger->info('email sent');
        $this->addFlash('notice', 'Email sent');

        return $this->render('doctor/doctor-schedule.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }
     
}

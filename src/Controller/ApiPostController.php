<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\RendezVous;

use Symfony\Component\HttpFoundation\Request;


class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/post", name="api_post_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository,SerializerInterface $serializer ): Response
    {
        return $this->json($userRepository->findAll(), 200, [], ['groups' =>'post:read']);

    }
     /**
     * @Route("/api/post", name="  api_post_store", methods={"POST"})
     */
    public function recu(Request $request,SerializerInterface $serializer, EntityManagerInterface $em ): Response
    {

        $parameters = $request->request;
        if(empty($parameters)){
            $response = $this->json([
                'statut'=> 400,
                'message'=> 'ellement manquant !'
            ] , 400 );
            $response->headers->set('Access-Control-Allow-Origin','*');
            return $response;
        }

        // $post = $serializer->deserialize($jsonrecu, User::class, 'json');
        $userRecu = new User();
        $userRecu->setNom($parameters->get("Nom"));
        $userRecu->setPrenom($parameters->get("Prenom"));
        $userRecu->setProfession($parameters->get("Profession"));
        $userRecu->setTelephone($parameters->get("Telephone"));
        $userRecu->setAge($parameters->get("Age"));
        $userRecu->setEmail($parameters->get("Email"));
        $userRecu->setGenre($parameters->get("Genre"));
        $userRecu->setCin($parameters->get("Cin"));
        $userRecu->setImage($parameters->get("Image"));
        $userRecu->setVille($parameters->get("Ville"));
        $hash1 = password_hash($parameters->get("pasword"),PASSWORD_BCRYPT,array('cost' => 11));
        $userRecu->setPassword($hash1);
        $userRecu->setCouvSociale($parameters->get("CouvSociale"));
        // $userRecu->setfi($parameters->get("Nom"));
        $em->persist($userRecu);
        $em->flush();
        $response = $this->json([
            'statut'=> 200,
            'message'=> 'L\'utilisateur a bien été enregistrer !'
        ] , 200 );
        $response->headers->set('Access-Control-Allow-Origin','*');
        return $response;
       // dd($jsonrecu);

    }
    /**
     * @Route("/api/rv", name="  api_post_rendezvous", methods={"POST"})
     */
    public function RV(Request $request,SerializerInterface $serializer, EntityManagerInterface $em ): Response
    {

        $parameters = $request->request;
        if(empty($parameters)){
            $response = $this->json([
                'statut'=> 400,
                'message'=> 'ellement manquant !'
            ] , 400 );
            $response->headers->set('Access-Control-Allow-Origin','*');
            return $response;
        }

        $rendez = new RendezVous();
        $rendez->setDate($parameters->get("Date"));
        $rendez->setLname($parameters->get("Lname"));
        $rendez->setFname($parameters->get("Fname"));
        $rendez->setTelephone($parameters->get("Telephone"));
        $rendez->setEmail($parameters->get("Email"));
        
        // $rv = $serializer->deserialize($jsonrecu, RendezVous::class, 'json');
        $em->persist($rendez);
        $em->flush();
        $response = $this->json([
            'statut'=> 200,
            'message'=> 'Votre rendez-vous a bien été enregistrer !'
        ] , 200 );
        $response->headers->set('Access-Control-Allow-Origin','*');
        return $response;
       

    }
}

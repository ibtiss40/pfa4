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

        $jsonrecu = $request->getContent();
        if(empty($jsonrecu)){
            $response = $this->json([
                'statut'=> 400,
                'message'=> 'ellement manquant !'
            ] , 400 );
            $response->headers->set('Access-Control-Allow-Origin','*');
            return $response;
        }
        $post = $serializer->deserialize($jsonrecu, User::class, 'json');

        $em->persist($post);
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

        $jsonrecu = $request->getContent();
        // dd($jsonrecu);
        if(empty($jsonrecu)){
            $response = $this->json([
                'statut'=> 400,
                'message'=> 'ellement manquant !'
            ] , 400 );
            $response->headers->set('Access-Control-Allow-Origin','*');
            return $response;
        }
        $rv = $serializer->deserialize($jsonrecu, RendezVous::class, 'json');
        $em->persist($rv);
        $em->flush();
        $response = $this->json([
            'statut'=> 200,
            'message'=> 'Votre rendez-vous a bien été enregistrer !'
        ] , 200 );
        $response->headers->set('Access-Control-Allow-Origin','*');
        return $response;
       

    }
}

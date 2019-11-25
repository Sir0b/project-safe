<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
<<<<<<< HEAD
use App\Entity\Password;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/passpass", name="passpass")
     */
=======
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Password;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/passpass", name="passpass")
 */
>>>>>>> 7a1be16f73c27a4260d7ac67fd91131425b22db5
class PasspassController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

<<<<<<< HEAD
    /**
     * @Route("/", methods="GET")
     */
    public function all()
    {
        $repo = $this->getDoctrine()->getRepository(Password::class);
        $password = $repo->findAll();
        $json = $this->serializer->serialize($password , "json");

        return JsonResponse::fromJsonString($json);       
    }

    /**
     * @Route("/{id}", methods="GET")
     */
    public function findOne(Password $password) 
    {
        $json = $this->serializer->serialize($password, "json");
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/", methods="POST")
     */
    public function create(Request $req) {
        $repo = $this->getDoctrine()->getManager();
        $password = $this->serializer->deserialize($req->getContent(), Password::class, "json");
        $repo->persist($password);
        $repo->flush();
        $json = $this->serializer->serialize($password, "json");

        return JsonResponse::fromJsonString($json, 201);
    }

    /**
     * @Route("/{id}", methods="DELETE")
     */
    public function erase(Password $password) {
        $repo = $this->getDoctrine()->getManager();
        $repo->remove($password);
        $repo->flush();
    }

    /**
     * @Route("/{id}", methods="PUT")
     */
    public function update(Password $password, Request $req) {
        $repo = $this->getDoctrine()->getManager();
        $body = $this->serializer->deserialize($req->getContent(), Password::class, "json");
        $password->setName($body->getName());
        $password->setUrl($body->getUrl());
        $password->setEmail($body->getEmail());
        $password->setUsername($body->getUsername());
        $password->setValue($body->getValue());
        $password->setCategory($body->getCategory());

        $repo->flush();

        $json = $this->seerializer->serialize($password, "json");
=======
    /**
     * @Route("/", methods={"GET"})
     */
    public function all()
    {
        $repo = $this->getDoctrine()->getRepository(Password::class);

        $json = $this->serializer->serialize($repo->findAll(), 'json');

        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/", methods={"POST"})
     */
    public function create(Request $req)
    {
        $body = $req->getContent();

        $password = $this->serializer->deserialize($body, Password::class, 'json');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($password);
        $entityManager->flush();

        return new JsonResponse(['id' => $password->getId()]);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function single(Password $password)
    {
        $json = $this->serialiazer->serialize($password, 'json');
>>>>>>> 7a1be16f73c27a4260d7ac67fd91131425b22db5

        return JsonResponse::fromJsonString($json);
    }
}

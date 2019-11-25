<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Password;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/passpass", name="passpass")
     */
class PasspassController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

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

        return JsonResponse::fromJsonString($json);
    }
}

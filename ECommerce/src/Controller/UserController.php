<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/api/updateInfo", name="updateInfo", methods={"POST"})
     */
    public function updateInfo()
    {
        $content = $_POST;
        /** @var User $user */
        $user = $this->getUser();

        $entityManager = $this->getDoctrine()->getManager();


        $user->setEmail($content['email']);
        $user->setUsername($content['username']);


        $entityManager->persist($user);

        $entityManager->flush();

        return new JsonResponse(
            [
                'success' => true,
            ]
        );
    }

    /**
     * @Route("/api/getAllUsers", name="apiGetAllUsers", methods={"GET"})
     */
    public function apiGetAllUsers()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $arrayCollection = [];

        /** @var User $item */
        foreach($users as $item) {
            $arrayCollection[] = array(
                'id' => $item->getId(),
                'username' => $item->getUsername(),
                'email' => $item->getEmail(),
                'enabled' => $item->isEnabled(),
                'roles' => $item->getRoles(),
                'delivery_country' => $item->getDeliveryCountry(),
                'delivery_city' => $item->getDeliveryCity(),
                'delivery_zip' => $item->getDeliveryZip(),
                'delivery_address' => $item->getDeliveryAddress(),
                'promotion_percent' => $item->getPromotionPercent(),
                'birth_date' => $item->getBirthDate(),
                'creation_date' => $item->getCreationDate(),
                'image' => $item->getImage()
            );
        }
        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/getUser/{id}", name="apiGetUser", methods={"GET"})
     */
    public function apiGetUser($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $arrayCollection[] = array(
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'enabled' => $user->isEnabled(),
            'roles' => $user->getRoles(),
            'delivery_country' => $user->getDeliveryCountry(),
            'delivery_city' => $user->getDeliveryCity(),
            'delivery_zip' => $user->getDeliveryZip(),
            'delivery_address' => $user->getDeliveryAddress(),
            'promotion_percent' => $user->getPromotionPercent(),
            'birth_date' => $user->getBirthDate(),
            'creation_date' => $user->getCreationDate(),
            'image' => $user->getImage()
        );

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/createUser", name="apiCreateUser", methods={"POST"})
     */
    public function apiCreateUser()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setUsername('crdseate');
        $user->setEmail('creatdfde@mail.com');
        $user->setEnabled(true);
        $user->setPassword('lol');
        $user->addRole('ROLE_USER');
        $user->setDeliveryCountry('xreate');
        $user->setDeliveryCity('xreate');
        $user->setDeliveryZip('xreate');
        $user->setDeliveryAddress('xreate');
        $user->setPromotionPercent(10);
        $user->setBirthDate(new \DateTime());
        $user->setCreationDate(new \DateTime());
        $user->setImage('xreate');

        $arrayCollection[] = array(
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'enabled' => $user->isEnabled(),
            'roles' => $user->getRoles(),
            'delivery_country' => $user->getDeliveryCountry(),
            'delivery_city' => $user->getDeliveryCity(),
            'delivery_zip' => $user->getDeliveryZip(),
            'delivery_address' => $user->getDeliveryAddress(),
            'promotion_percent' => $user->getPromotionPercent(),
            'birth_date' => $user->getBirthDate(),
            'creation_date' => $user->getCreationDate(),
            'image' => $user->getImage()
        );

        $entityManager->persist($user);

        $entityManager->flush();

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/manageUser/{id}", name="apiManageUser", methods={"POST"})
     */
    public function apiManageUser($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var  User $user */
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $user->setUsername('modif');
        $user->setEmail('modif@mail.com');
        $user->setEnabled(true);
        $user->setPassword('caca');
        $user->addRole('ROLE_USER');
        $user->setDeliveryCountry('modif');
        $user->setDeliveryCity('modif');
        $user->setDeliveryZip('modif');
        $user->setDeliveryAddress('modif');
        $user->setPromotionPercent(0);
        $user->setBirthDate(new \DateTime());
        $user->setCreationDate(new \DateTime());
        $user->setImage('modif');

        $arrayCollection[] = array(
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'enabled' => $user->isEnabled(),
            'roles' => $user->getRoles(),
            'delivery_country' => $user->getDeliveryCountry(),
            'delivery_city' => $user->getDeliveryCity(),
            'delivery_zip' => $user->getDeliveryZip(),
            'delivery_address' => $user->getDeliveryAddress(),
            'promotion_percent' => $user->getPromotionPercent(),
            'birth_date' => $user->getBirthDate(),
            'creation_date' => $user->getCreationDate(),
            'image' => $user->getImage()
        );

        $entityManager->persist($user);

        $entityManager->flush();

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/deleteUser/{id}", name="apiDeleteUser", methods={"POST"})
     */
    public function apiDeleteUser($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $entityManager->remove($user);

        $entityManager->flush();

        return new JsonResponse(array("deletion" => "success"));
    }
}

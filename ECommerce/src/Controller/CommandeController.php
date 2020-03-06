<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commande")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/", name="commande_index", methods={"GET"})
     */
    public function index(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/api/getAllCommandes", name="apiGetAllCommandes", methods={"GET"})
     */
    public function apiGetAllCommandes()
    {
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findAll();

        $arrayCollection = [];

        /** @var Commande $item */
        foreach($commandes as $item) {
            $arrayCollection[] = array(
                'id' => $item->getId(),
                'etat' => $item->getEtat(),
                'date_commande' => $item->getDateCommande(),
                'mode_livraison' => $item->getModeLivraison(),
                'qte' => $item->getQte(),
                'prix_article_commande' => $item->getPrixArticleCommande(),
                'frais_port' => $item->getFraisPort(),
                'delivery_country' => $item->getDeliveryCountry(),
                'delivery_city' => $item->getDeliveryCity(),
                'delivery_zip' => $item->getDeliveryZip(),
                'delivery_address' => $item->getDeliveryAddress(),
                'mail_vendeur' => $item->getMailVendeur(),
                'nom_vendeur' => $item->getNomVendeur(),
                'code_command' => $item->getCodeCommand()
            );
        }
        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/getCommande/{code_command}", name="apiGetCommande", methods={"GET"})
     */
    public function apiGetCommande($code_command)
    {
        $commande = $this->getDoctrine()->getRepository(Commande::class)->findBy(['code_command' => $code_command]);

        $arrayCollection = [];

        /** @var Commande $item */
        foreach($commande as $item) {
            $arrayCollection[] = array(
                'id' => $item->getId(),
                'etat' => $item->getEtat(),
                'date_commande' => $item->getDateCommande(),
                'mode_livraison' => $item->getModeLivraison(),
                'qte' => $item->getQte(),
                'prix_article_commande' => $item->getPrixArticleCommande(),
                'frais_port' => $item->getFraisPort(),
                'delivery_country' => $item->getDeliveryCountry(),
                'delivery_city' => $item->getDeliveryCity(),
                'delivery_zip' => $item->getDeliveryZip(),
                'delivery_address' => $item->getDeliveryAddress(),
                'mail_vendeur' => $item->getMailVendeur(),
                'nom_vendeur' => $item->getNomVendeur(),
                'code_command' => $item->getCodeCommand()
            );
        }

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/createCommande", name="apiCreateCommande", methods={"POST"})
     */
    public function apiCreateCommande()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $commande = new Commande();

        $commande->setEtat('commande');
        $commande->setDateCommande(new \DateTime());
        $commande->setModeLivraison('Chronopost');
        $commande->setQte(1);
        $commande->setPrixArticleCommande(19.20);
        $commande->setFraisPort(40);
        $commande->setDeliveryCountry('create');
        $commande->setDeliveryCity('create');
        $commande->setDeliveryZip('create');
        $commande->setDeliveryAddress('create');
        $commande->setMailVendeur('create');
        $commande->setNomVendeur('create');

        /** @var Commande $code_command */
        $code_command = $this->getDoctrine()->getRepository(Commande::class)->findLast();

        if($code_command) {
            $commande->setCodeCommand($code_command->getCodeCommand() + 1);
        } else {
            $commande->setCodeCommand(1);
        }


        $arrayCollection[] = array(
            'id' => $commande->getId(),
            'etat' => $commande->getEtat(),
            'date_commande' => $commande->getDateCommande(),
            'mode_livraison' => $commande->getModeLivraison(),
            'qte' => $commande->getQte(),
            'prix_article_commande' => $commande->getPrixArticleCommande(),
            'frais_port' => $commande->getFraisPort(),
            'delivery_country' => $commande->getDeliveryCountry(),
            'delivery_city' => $commande->getDeliveryCity(),
            'delivery_zip' => $commande->getDeliveryZip(),
            'delivery_address' => $commande->getDeliveryAddress(),
            'mail_vendeur' => $commande->getMailVendeur(),
            'nom_vendeur' => $commande->getNomVendeur(),
            'code_command' => $commande->getCodeCommand()
        );

        $entityManager->persist($commande);

        $entityManager->flush();

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/manageCommande/{id}", name="apiManageCommande", methods={"POST"})
     */
    public function apiManageCommande($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var  Commande $commande */
        $commande = $this->getDoctrine()->getRepository(Commande::class)->find($id);

        $commande->setEtat('en cours d\'acheminement');
        $commande->setDateCommande(new \DateTime());
        $commande->setModeLivraison('modif');
        $commande->setQte(1);
        $commande->setPrixArticleCommande(19.20);
        $commande->setFraisPort(40);
        $commande->setDeliveryCountry('mdoif');
        $commande->setDeliveryCity('mdoif');
        $commande->setDeliveryZip('mdoif');
        $commande->setDeliveryAddress('mdoif');
        $commande->setMailVendeur('mdoif');
        $commande->setNomVendeur('mdoif');
        $commande->setCodeCommand(223);

        $arrayCollection[] = array(
            'id' => $commande->getId(),
            'etat' => $commande->getEtat(),
            'date_commande' => $commande->getDateCommande(),
            'mode_livraison' => $commande->getModeLivraison(),
            'qte' => $commande->getQte(),
            'prix_article_commande' => $commande->getPrixArticleCommande(),
            'frais_port' => $commande->getFraisPort(),
            'delivery_country' => $commande->getDeliveryCountry(),
            'delivery_city' => $commande->getDeliveryCity(),
            'delivery_zip' => $commande->getDeliveryZip(),
            'delivery_address' => $commande->getDeliveryAddress(),
            'mail_vendeur' => $commande->getMailVendeur(),
            'nom_vendeur' => $commande->getNomVendeur(),
            'code_command' => $commande->getCodeCommand()
        );

        $entityManager->persist($commande);

        $entityManager->flush();

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/deleteCommande/{code_command}", name="apiDeleteCommande", methods={"POST"})
     */
    public function apiDeleteCommande($code_command)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $commande = $this->getDoctrine()->getRepository(Commande::class)->findBy(['code_command' => $code_command]);

        /** @var Commande $item */
        foreach($commande as $item) {
                $entityManager->remove($item);
        }



        $entityManager->flush();

        return new JsonResponse(array("deletion" => "success"));
    }


    /**
     * @Route("/new", name="commande_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->redirectToRoute('commande_index');
        }

        return $this->render('commande/new.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_show", methods={"GET"})
     */
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commande $commande): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_index');
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commande $commande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_index');
    }
}

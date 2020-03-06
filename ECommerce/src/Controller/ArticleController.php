<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/promotion", name="article_promotion", methods={"GET"})
     */
    public function promotion(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAllPromo(),
        ]);
    }

    /**
     * @Route("/api/getAllArticles", name="apiGetAllArticles", methods={"GET"})
     */
    public function apiGetAllArticles()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        $arrayCollection = [];

        /** @var Article $item */
        foreach($articles as $item) {
            $arrayCollection[] = array(
                'id' => $item->getId(),
                'nom' => $item->getNom(),
                'categorie' => $item->getCategorie(),
                'description' => $item->getDescription(),
                'caracteristiques' => $item->getCaracteristiques(),
                'prix_unitaire' => $item->getPrixUnitaire(),
                'poids' => $item->getPoids(),
                'qte_en_stock' => $item->getQteEnStock(),
                'is_new' => $item->getIsNew(),
                'promotion' => $item->getPromotion()
            );
        }
        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/searchByterm", name="apiSearchArticle", methods={"POST"})
     */
    public function searchByTerm()
    {
        $content = $_POST;

        $term = $content['term'];

        /** @var Article $articles */
        $articles = $this->getDoctrine()->getRepository(Article::class)->findByTerm($term);

        $arrayCollection = [];

        //TODO
//        foreach ($articles as $article)
//        {
//            $arrayCollection[] = {}
//        }



        return new JsonResponse([
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/api/getArticle/{id}", name="apiGetArticle", methods={"GET"})
     */
    public function apiGetArticle($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $arrayCollection[] = array(
            'id' => $article->getId(),
            'nom' => $article->getNom(),
            'categorie' => $article->getCategorie(),
            'description' => $article->getDescription(),
            'caracteristiques' => $article->getCaracteristiques(),
            'prix_unitaire' => $article->getPrixUnitaire(),
            'poids' => $article->getPoids(),
            'qte_en_stock' => $article->getQteEnStock(),
            'is_new' => $article->getIsNew(),
            'promotion' => $article->getPromotion()
        );

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/createArticle", name="apiCreateArticle", methods={"POST"})
     */
    public function apiCreateArticle()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setNom('test');
        $article->setPoids(0);
        $article->setPrixUnitaire(0);
        $article->setDescription('');
        $article->setCategorie('');
        $article->setCaracteristiques('');
        $article->setQteEnStock(0);
        $article->setIsNew(true);
        $article->setPromotion(0);

        $arrayCollection[] = array(
            'id' => $article->getId(),
            'nom' => $article->getNom(),
            'categorie' => $article->getCategorie(),
            'description' => $article->getDescription(),
            'caracteristiques' => $article->getCaracteristiques(),
            'prix_unitaire' => $article->getPrixUnitaire(),
            'poids' => $article->getPoids(),
            'qte_en_stock' => $article->getQteEnStock(),
            'is_new' => $article->getIsNew(),
            'promotion' => $article->getPromotion()
        );

        $entityManager->persist($article);

        $entityManager->flush();

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/manageArticle/{id}", name="apiManageArticle", methods={"POST"})
     */
    public function apiManageArticle($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $article->setNom('modifnom');
        $article->setCategorie('modif');
        $article->setDescription('modif');
        $article->setCaracteristiques('modif');
        $article->setPrixUnitaire(60);
        $article->setPoids(9.2);
        $article->setQteEnStock(10);
        $article->setIsNew(true);
        $article->setPromotion(10);

        $arrayCollection[] = array(
            'id' => $article->getId(),
            'nom' => $article->getNom(),
            'categorie' => $article->getCategorie(),
            'description' => $article->getDescription(),
            'caracteristiques' => $article->getCaracteristiques(),
            'prix_unitaire' => $article->getPrixUnitaire(),
            'poids' => $article->getPoids(),
            'qte_en_stock' => $article->getQteEnStock(),
            'is_new' => $article->getIsNew(),
            'promotion' => $article->getPromotion()
        );

        $entityManager->persist($article);

        $entityManager->flush();

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/deleteArticle/{id}", name="apiDeleteArticle", methods={"POST"})
     */
    public function apiDeleteArticle($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $entityManager->remove($article);

        $entityManager->flush();

        return new JsonResponse(array("deletion" => "success"));
    }

    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        $session = $this->get('session');
        $cartElements = $session->get('cartElements');
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'cart' => $cartElements
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }
}

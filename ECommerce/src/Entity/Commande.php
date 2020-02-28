<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCommande;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modeLivraison;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prixArticleCommande;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $fraisPort;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getModeLivraison(): ?string
    {
        return $this->modeLivraison;
    }

    public function setModeLivraison(string $modeLivraison): self
    {
        $this->modeLivraison = $modeLivraison;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPrixArticleCommande(): ?string
    {
        return $this->prixArticleCommande;
    }

    public function setPrixArticleCommande(string $prixArticleCommande): self
    {
        $this->prixArticleCommande = $prixArticleCommande;

        return $this;
    }

    public function getFraisPort(): ?string
    {
        return $this->fraisPort;
    }

    public function setFraisPort(string $fraisPort): self
    {
        $this->fraisPort = $fraisPort;

        return $this;
    }
}

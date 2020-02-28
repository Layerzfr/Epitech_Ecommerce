<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prixArticlePanier;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="cart")
     */
    private $commandes;

    /**
     * @return mixed
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * @param mixed $commandes
     */
    public function setCommandes($commandes)
    {
        $this->commandes = $commandes;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrixArticlePanier(): ?string
    {
        return $this->prixArticlePanier;
    }

    public function setPrixArticlePanier(string $prixArticlePanier): self
    {
        $this->prixArticlePanier = $prixArticlePanier;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\InteractionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InteractionsRepository::class)]
class Interactions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Initiator = null;

    #[ORM\Column(length: 255)]
    private ?string $InteractionType = null;

    #[ORM\ManyToOne]
    private ?User $InteractionTo = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $ProductConcerned = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitiator(): ?User
    {
        return $this->Initiator;
    }

    public function setInitiator(?User $Initiator): static
    {
        $this->Initiator = $Initiator;

        return $this;
    }

    public function getInteractionType(): ?string
    {
        return $this->InteractionType;
    }

    public function setInteractionType(string $InteractionType): static
    {
        $this->InteractionType = $InteractionType;

        return $this;
    }

    public function getInteractionTo(): ?User
    {
        return $this->InteractionTo;
    }

    public function setInteractionTo(?User $InteractionTo): static
    {
        $this->InteractionTo = $InteractionTo;

        return $this;
    }

    public function getProductConcerned(): ?Product
    {
        return $this->ProductConcerned;
    }

    public function setProductConcerned(?Product $ProductConcerned): static
    {
        $this->ProductConcerned = $ProductConcerned;

        return $this;
    }
}

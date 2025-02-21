<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'products')]
    private Collection $seller;

    #[ORM\Column(length: 255)]
    private ?string $imgLink = null;

    #[ORM\Column(type: 'datetime')]
    private DateTime $sellingDateTime;

    #[ORM\Column(type: Types::DECIMAL, precision: 2, scale: 5)]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->seller = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    
    public function getSeller(): Collection
    {
        return $this->seller;
    }

    public function addSeller(User $seller): static
    {
        if (!$this->seller->contains($seller)) {
            $this->seller->add($seller);
        }

        return $this;
    }

    public function removeSeller(User $seller): static
    {
        $this->seller->removeElement($seller);

        return $this;
    }

    public function getSellingDateTime(): ?DateTime
    {
        return $this->sellingDateTime;
    }

    public function setSellingDateTime(DateTime $datetime): static
    {
        $this->sellingDateTime = $datetime;

        return $this;
    }

    public function getImageLink(): ?string
    {
        return $this->imgLink;
    }

    public function setImageLink(string $imgLink): static
    {
        $this->imgLink = $imgLink;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}

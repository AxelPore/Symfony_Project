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

    #[ORM\Column]
    private ?bool $isActive = true;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    private ?Category $category = null;

    #[ORM\Column(nullable: true)]
    private ?int $views = 0;

    #[ORM\Column(nullable: true)]
    private ?float $rating = 0.0;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Review::class)]
    private Collection $reviews;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductImage::class)]
    private Collection $images;

    public function __construct()
    {
        $this->seller = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(?int $views): static
    {
        $this->views = $views;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function getImgLink(): ?string
    {
        return $this->imgLink;
    }

    public function setImgLink(string $imgLink): static
    {
        $this->imgLink = $imgLink;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setProduct($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getProduct() === $this) {
                $review->setProduct(null);
            }
        }

        return $this;
    }

    public function addImage(ProductImage $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(ProductImage $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }
}

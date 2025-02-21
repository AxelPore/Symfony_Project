document.addEventListener('DOMContentLoaded', function() {
    // Galerie d'images
    const mainImage = document.querySelector('.main-image img');
    const thumbnails = document.querySelectorAll('.thumbnail');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Mise à jour de l'image principale
            mainImage.src = this.querySelector('img').src;
            
            // Mise à jour de la classe active
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Ajout au panier
    const addToCartBtn = document.querySelector('.add-to-cart');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            const productId = this.dataset.product;
            
            // Animation du bouton
            this.classList.add('adding');
            
            // Appel AJAX pour ajouter au panier
            fetch('/cart/add/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Animation de succès
                    this.innerHTML = '<i class="fas fa-check"></i> Ajouté !';
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-shopping-cart"></i> Ajouter au panier';
                        this.classList.remove('adding');
                    }, 2000);
                }
            });
        });
    }

    // Filtres de catégorie
    const sortSelect = document.querySelector('.sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const value = this.value;
            const productGrid = document.querySelector('.product-grid');
            const products = Array.from(productGrid.children);

            products.sort((a, b) => {
                if (value === 'price-asc') {
                    return getPrice(a) - getPrice(b);
                } else if (value === 'price-desc') {
                    return getPrice(b) - getPrice(a);
                }
                // Ajoutez d'autres critères de tri ici
            });

            // Réorganiser les produits
            productGrid.innerHTML = '';
            products.forEach(product => productGrid.appendChild(product));
        });
    }
});

// Fonction utilitaire pour extraire le prix
function getPrice(productElement) {
    const priceText = productElement.querySelector('.price').textContent;
    return parseFloat(priceText.replace('€', '').trim());
} 
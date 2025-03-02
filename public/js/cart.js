document.addEventListener('DOMContentLoaded', function() {
    console.log('Cart JS loaded');

    // Initialiser le compteur
    updateCartCount();

    // Gérer les boutons d'achat
    const buyButtons = document.querySelectorAll('.buy-now');
    
    buyButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const packData = {
                type: this.dataset.type,
                id: this.dataset.id,
                name: this.dataset.name,
                price: this.dataset.price
            };

            // Appel à l'API pour ajouter au panier
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(packData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour le compteur
                    updateCartCount();
                    animateCartButton();
                    showNotification(`${packData.name} ajouté au panier`);
                    
                    // Ajouter cette condition pour fermer le popup si nécessaire
                    if (this.closest('.world-popup')) {
                        const popup = this.closest('.world-popup');
                        const overlay = document.querySelector('.popup-overlay');
                        if (popup && overlay) {
                            popup.style.display = 'none';
                            overlay.style.display = 'none';
                            document.body.style.overflow = 'auto';
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Erreur lors de l\'ajout au panier', 'error');
            });
        });
    });

    // Gérer la suppression des articles
    setupRemoveButtons();

    // Fonction pour configurer les boutons de suppression
    function setupRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-item');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.dataset.id;
                const cartItem = this.closest('.cart-item');
                
                fetch(`/cart/remove/${itemId}`, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Animation de suppression
                        cartItem.style.animation = 'slideOut 0.3s ease-out';
                        setTimeout(() => {
                            cartItem.remove();
                            updateCartTotal();
                            updateCartCount();
                            checkEmptyCart();
                        }, 300);
                        
                        showNotification('Article supprimé du panier');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showNotification('Erreur lors de la suppression', 'error');
                });
            });
        });
    }

    // Fonction pour vérifier si le panier est vide
    function checkEmptyCart() {
        const cartItems = document.querySelector('.cart-items');
        if (!cartItems || cartItems.children.length === 0) {
            const cartSection = document.querySelector('.cart-section');
            if (cartSection) {
                cartSection.innerHTML = `
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <h2>Votre panier est vide</h2>
                        <p>Découvrez nos mondes incroyables et commencez votre aventure !</p>
                        <a href="${window.location.origin}" class="return-button">
                            Retour aux mondes
                        </a>
                    </div>
                `;
            }
        }
    }

    // Fonction pour mettre à jour le total du panier
    function updateCartTotal() {
        fetch('/cart/total')
            .then(response => response.json())
            .then(data => {
                const totalElement = document.querySelector('.cart-total h3');
                if (totalElement) {
                    totalElement.textContent = `Total : ${data.total} €`;
                }
            });
    }

    // Fonction pour animer le bouton panier
    function animateCartButton() {
        const cartButton = document.querySelector('.btn-profile i.fa-shopping-cart');
        if (cartButton) {
            cartButton.classList.add('pulse');
            setTimeout(() => {
                cartButton.classList.remove('pulse');
            }, 500);
        }
    }

    // Fonction pour afficher les notifications
    function showNotification(message, type = 'success') {
        // Supprimer toute notification existante
        const existingNotification = document.querySelector('.cart-notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        const notification = document.createElement('div');
        notification.className = `cart-notification ${type}`;
        
        // Ajouter une icône en fonction du type
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        notification.innerHTML = `
            <i class="fas ${icon}"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);

        // Animation d'entrée
        setTimeout(() => notification.classList.add('show'), 10);

        // Suppression après 3 secondes
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Fonction pour mettre à jour le compteur
    function updateCartCount() {
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                const cartCount = document.querySelector('.btn-profile .cart-count');
                if (cartCount) {
                    cartCount.textContent = data.count;
                    cartCount.style.display = data.count > 0 ? 'flex' : 'none';
                }
            });
    }
}); 
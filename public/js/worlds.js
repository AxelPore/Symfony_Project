document.addEventListener('DOMContentLoaded', function() {
    console.log('Initialisation du script...');

    // Sélectionner tous les boutons
    const buttons = document.querySelectorAll('.world-button');
    console.log('Boutons trouvés:', buttons.length);

    // Ajouter les écouteurs d'événements à chaque bouton
    buttons.forEach(button => {
        console.log('Bouton:', button.dataset.world);
        
        button.onclick = function(e) {
            e.preventDefault();
            console.log('Clic sur le bouton:', this.dataset.world);
            
            // Afficher l'overlay
            const overlay = document.querySelector('.popup-overlay');
            overlay.style.display = 'block';
            
            // Afficher le popup correspondant
            const popupId = `popup-${this.dataset.world}`;
            const popup = document.getElementById(popupId);
            console.log('Recherche du popup:', popupId);
            
            if (popup) {
                console.log('Popup trouvé, affichage...');
                popup.style.display = 'block';
                popup.classList.add('active');
                document.body.style.overflow = 'hidden';
            } else {
                console.error('Popup non trouvé:', popupId);
            }
        };
    });

    // Gestion de la fermeture
    const closeButtons = document.querySelectorAll('.popup-close');
    const overlay = document.querySelector('.popup-overlay');

    function closeAllPopups() {
        console.log('Fermeture des popups');
        document.querySelectorAll('.world-popup').forEach(popup => {
            popup.classList.remove('active');
            popup.style.display = 'none';
        });
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    closeButtons.forEach(button => {
        button.onclick = closeAllPopups;
    });

    overlay.onclick = closeAllPopups;

    // Fermeture avec la touche Echap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeAllPopups();
    });

    // Fonction pour mettre à jour le compteur
    function updateCartCount() {
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                const cartCount = document.querySelector('.cart-count');
                if (cartCount) {
                    cartCount.textContent = data.count;
                    cartCount.style.display = data.count > 0 ? 'inline-block' : 'none';
                }
            });
    }

    // Style pour l'animation du panier
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        .pulse {
            animation: pulse 0.5s ease-in-out;
        }
    `;
    document.head.appendChild(style);
}); 
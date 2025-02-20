document.addEventListener('DOMContentLoaded', function() {
    const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff'];
    
    function createTransitionElements() {
        // Conteneur hyperespace
        const hyperspace = document.createElement('div');
        hyperspace.className = 'hyperspace-container';
        
        const tunnel = document.createElement('div');
        tunnel.className = 'hyperspace-tunnel';
        hyperspace.appendChild(tunnel);
        
        // Créer les étoiles filantes horizontales
        for(let i = 0; i < 100; i++) {
            const star = document.createElement('div');
            star.className = 'star-line';
            
            // Ajouter des couleurs aléatoires
            if(Math.random() > 0.7) {
                star.classList.add(Math.random() > 0.5 ? 'blue' : 'purple');
            }
            
            star.style.top = `${Math.random() * 100}%`;
            star.style.width = `${Math.random() * 100 + 50}px`;
            
            // Varier la vitesse selon la position
            const speed = Math.random() * 0.5 + 0.5; // entre 0.5 et 1 seconde
            star.style.animation = `starTravel ${speed}s ${Math.random() * 0.5}s infinite linear`;
            
            tunnel.appendChild(star);
        }
        
        // Conteneur LINK START avec cercles
        const linkStartContainer = document.createElement('div');
        linkStartContainer.className = 'link-start-container';
        
        // Cercles SAO autour du texte
        colors.forEach((color, index) => {
            const circle = document.createElement('div');
            circle.className = 'sao-circle';
            circle.style.width = '100%';
            circle.style.height = '100%';
            circle.style.border = `2px solid ${color}`;
            circle.style.boxShadow = `0 0 20px ${color}`;
            linkStartContainer.appendChild(circle);
        });
        
        // Texte qui changera
        const text = document.createElement('div');
        text.className = 'link-start-text';
        linkStartContainer.appendChild(text);
        
        document.body.appendChild(hyperspace);
        document.body.appendChild(linkStartContainer);
        
        return { hyperspace, linkStartContainer, text };
    }
    
    const elements = createTransitionElements();
    
    document.querySelectorAll('.sao-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetUrl = this.href;
            
            // Nouvelle séquence avec LINK START à la fin
            const messages = [
                'VISION OK',
                'HEARING OK',
                'TOUCH OK',
                'TASTE OK',
                'SMELL OK',
                'INITIALIZING...',
                'LAUNCHING FULL DIVE...',
                'LINK START'  // Maintenant en dernier
            ];
            
            // Faire disparaître le contenu initial
            document.querySelector('.content').style.animation = 'contentFadeOut 0.5s forwards';
            
            // Démarrer l'effet hyperespace
            elements.hyperspace.style.display = 'block';
            
            // Animer les étoiles
            elements.hyperspace.querySelectorAll('.star-line').forEach((star, index) => {
                star.style.animation = `starTravel 1s ${Math.random() * 0.5}s infinite linear`;
            });
            
            // Séquence de messages
            let messageIndex = 0;
            const textElement = elements.text;
            
            function showNextMessage() {
                if (messageIndex < messages.length) {
                    textElement.textContent = messages[messageIndex];
                    
                    // Durée spéciale pour LINK START
                    const isLastMessage = messageIndex === messages.length - 1;
                    const duration = isLastMessage ? 1500 : 400; // 1.5s pour LINK START, 0.4s pour les autres
                    
                    textElement.style.animation = isLastMessage ? 
                        'textPulseFinal 1.5s forwards' : 
                        'textPulse 0.5s forwards';
                    
                    messageIndex++;
                    
                    // Attendre plus longtemps pour le dernier message
                    setTimeout(() => {
                        textElement.style.animation = 'none';
                        setTimeout(() => {
                            if (messageIndex < messages.length) {
                                showNextMessage();
                            }
                        }, 100);
                    }, duration);
                }
            }
            
            // Démarrer la séquence après 1 seconde
            setTimeout(() => {
                const circles = elements.linkStartContainer.querySelectorAll('.sao-circle');
                circles.forEach((circle, index) => {
                    circle.style.animation = `circleRotate 2s ${index * 0.2}s infinite`;
                });
                showNextMessage();
            }, 1000);
            
            // Augmenter le délai de redirection pour le LINK START final
            setTimeout(() => {
                window.location.href = targetUrl;
            }, 6000); // 6 secondes au total
        });
    });
});

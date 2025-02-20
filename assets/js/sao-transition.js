class SAOTransition {
    constructor() {
        this.createTransitionElements();
        this.initializeParticles();
    }

    createTransitionElements() {
        const transition = document.createElement('div');
        transition.className = 'sao-transition';
        
        transition.innerHTML = `
            <div class="hexagon-grid"></div>
            <div class="cyber-particles"></div>
            <div class="transition-overlay"></div>
            <div class="transition-text">LINK START</div>
        `;
        
        document.body.appendChild(transition);
    }

    initializeParticles() {
        const particlesContainer = document.querySelector('.cyber-particles');
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.animationDelay = `${Math.random() * 3}s`;
            particlesContainer.appendChild(particle);
        }
    }

    async transition(targetUrl) {
        const overlay = document.querySelector('.transition-overlay');
        const text = document.querySelector('.transition-text');
        
        // Début de la transition
        overlay.style.opacity = '1';
        text.style.opacity = '1';
        
        // Effet sonore (optionnel)
        const sound = new Audio('/path/to/transition-sound.mp3');
        sound.play();

        // Animation de particules intensifiée
        document.querySelectorAll('.particle').forEach(particle => {
            particle.style.animationDuration = '1s';
        });

        // Attendre la fin de l'animation
        await new Promise(resolve => setTimeout(resolve, 2000));

        // Redirection
        window.location.href = targetUrl;
    }
}

// Initialisation
document.addEventListener('DOMContentLoaded', () => {
    const transition = new SAOTransition();
    
    // Attacher aux liens de navigation
    document.querySelectorAll('.sao-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            transition.transition(link.href);
        });
    });
}); 
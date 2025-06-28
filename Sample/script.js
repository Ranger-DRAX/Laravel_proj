// Advanced JavaScript for Feastly Website
document.addEventListener('DOMContentLoaded', function() {
    
  // ============ HEADER EFFECTS ============
  
  // Dynamic header background on scroll
  const header = document.querySelector('.header');
  let lastScrollY = window.scrollY;
  
  window.addEventListener('scroll', () => {
      const currentScrollY = window.scrollY;
      
      if (currentScrollY > 50) {
          header.style.background = 'rgba(0, 0, 0, 0.95)';
          header.style.backdropFilter = 'blur(30px)';
          header.style.borderBottom = '1px solid rgba(255, 215, 0, 0.3)';
      } else {
          header.style.background = 'rgba(0, 0, 0, 0.1)';
          header.style.backdropFilter = 'blur(20px)';
          header.style.borderBottom = '1px solid rgba(255, 255, 255, 0.1)';
      }
      
      // Hide/show header based on scroll direction
      if (currentScrollY > lastScrollY && currentScrollY > 100) {
          header.style.transform = 'translateY(-100%)';
      } else {
          header.style.transform = 'translateY(0)';
      }
      
      lastScrollY = currentScrollY;
  });
  
  // ============ NAVIGATION EFFECTS ============
  
  // Enhanced navigation hover effects
  const navLinks = document.querySelectorAll('.nav-link');
  navLinks.forEach(link => {
      link.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-3px) scale(1.05)';
          this.style.textShadow = '0 5px 15px rgba(255, 215, 0, 0.5)';
          
          // Ripple effect
          const ripple = document.createElement('div');
          ripple.style.cssText = `
              position: absolute;
              top: 50%;
              left: 50%;
              width: 0;
              height: 0;
              background: rgba(255, 215, 0, 0.3);
              border-radius: 50%;
              transform: translate(-50%, -50%);
              transition: all 0.6s ease;
              pointer-events: none;
              z-index: -1;
          `;
          
          this.appendChild(ripple);
          
          setTimeout(() => {
              ripple.style.width = '200px';
              ripple.style.height = '200px';
              ripple.style.opacity = '0';
          }, 10);
          
          setTimeout(() => {
              if (ripple.parentNode) {
                  ripple.parentNode.removeChild(ripple);
              }
          }, 600);
      });
      
      link.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0) scale(1)';
          this.style.textShadow = 'none';
      });
  });
  
  // ============ BUTTON EFFECTS ============
  
  // Login button advanced effects
  const loginBtn = document.querySelector('.login-btn');
  loginBtn.addEventListener('click', function(e) {
      // Create ripple effect
      const rect = this.getBoundingClientRect();
      const ripple = this.querySelector('.btn-ripple');
      
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;
      
      ripple.style.width = ripple.style.height = size + 'px';
      ripple.style.left = x + 'px';
      ripple.style.top = y + 'px';
      
      // Button shake effect
      this.style.animation = 'buttonShake 0.5s ease';
      setTimeout(() => {
          this.style.animation = '';
      }, 500);
  });
  
  // CTA buttons enhanced effects
  const ctaButtons = document.querySelectorAll('.cta-btn');
  ctaButtons.forEach(btn => {
      btn.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-8px) scale(1.08)';
          this.style.filter = 'brightness(1.2) saturate(1.3)';
          
          // Add pulsing glow
          const glow = document.createElement('div');
          glow.className = 'btn-glow-effect';
          glow.style.cssText = `
              position: absolute;
              top: -5px;
              left: -5px;
              right: -5px;
              bottom: -5px;
              background: inherit;
              border-radius: inherit;
              filter: blur(15px);
              opacity: 0.7;
              z-index: -1;
              animation: pulseGlow 1.5s infinite ease-in-out;
          `;
          
          this.appendChild(glow);
      });
      
      btn.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0) scale(1)';
          this.style.filter = 'brightness(1) saturate(1)';
          
          const glow = this.querySelector('.btn-glow-effect');
          if (glow) {
              glow.remove();
          }
      });
      
      btn.addEventListener('click', function() {
          // Button success animation
          const originalText = this.querySelector('.btn-content').innerHTML;
          const btnContent = this.querySelector('.btn-content');
          
          btnContent.innerHTML = '<i class="fas fa-check"></i> Success!';
          this.style.background = 'linear-gradient(45deg, #32CD32, #228B22)';
          
          setTimeout(() => {
              btnContent.innerHTML = originalText;
              this.style.background = '';
          }, 2000);
      });
  });
  
  // ============ PARALLAX EFFECTS ============
  
  // Advanced parallax for background elements
  const floatingElements = document.querySelectorAll('.floating-element');
  const particles = document.querySelectorAll('.particle');
  const lightOrbs = document.querySelectorAll('.light-orb');
  
  window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const rate = scrolled * -0.5;
      
      // Parallax for floating elements
      floatingElements.forEach((element, index) => {
          const speed = (index + 1) * 0.3;
          element.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
      });
      
      // Parallax for particles
      particles.forEach((particle, index) => {
          const speed = (index + 1) * 0.2;
          particle.style.transform = `translateY(${scrolled * speed}px)`;
      });
      
      // Dynamic light orbs movement
      lightOrbs.forEach((orb, index) => {
          const speed = (index + 1) * 0.15;
          const rotation = scrolled * 0.05;
          orb.style.transform = `translateY(${scrolled * speed}px) rotate(${rotation}deg)`;
      });
  });
  
  // ============ MOUSE TRACKING EFFECTS ============
  
  // Mouse tracking for hero content
  const heroContent = document.querySelector('.hero-content');
  const hero = document.querySelector('.hero');
  
  hero.addEventListener('mousemove', (e) => {
      const rect = hero.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width;
      const y = (e.clientY - rect.top) / rect.height;
      
      const moveX = (x - 0.5) * 20;
      const moveY = (y - 0.5) * 20;
      
      heroContent.style.transform = `translate(${moveX}px, ${moveY}px)`;
  });
  
  hero.addEventListener('mouseleave', () => {
      heroContent.style.transform = 'translate(0, 0)';
  });
  
  // ============ RESTAURANT SCENE INTERACTIVITY ============
  
  // Interactive restaurant table
  const tableContainer = document.querySelector('.table-container');
  const plates = document.querySelectorAll('.plate');
  const glasses = document.querySelectorAll('.wine-glass');
  const candle = document.querySelector('.candle');
  
  // Table rotation on mouse move
  if (tableContainer) {
      tableContainer.addEventListener('mousemove', (e) => {
          const rect = tableContainer.getBoundingClientRect();
          const x = (e.clientX - rect.left) / rect.width;
          const y = (e.clientY - rect.top) / rect.height;
          
          const rotateX = (y - 0.5) * 10;
          const rotateY = (x - 0.5) * 10;
          
          tableContainer.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
      });
      
      tableContainer.addEventListener('mouseleave', () => {
          tableContainer.style.transform = 'rotateX(0deg) rotateY(0deg)';
      });
  }
  
  // Enhanced plate interactions
  plates.forEach((plate, index) => {
      plate.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-10px) scale(1.15) rotateZ(5deg)';
          this.style.filter = 'brightness(1.3) drop-shadow(0 10px 20px rgba(255, 215, 0, 0.4))';
          
          // Food item animation
          const foodItem = this.querySelector('.food-item');
          if (foodItem) {
              foodItem.style.animation = 'foodSizzle 0.5s ease infinite';
          }
          
          // Sound effect simulation (visual feedback)
          this.style.boxShadow = '0 0 30px rgba(255, 215, 0, 0.8)';
      });
      
      plate.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0) scale(1) rotateZ(0deg)';
          this.style.filter = 'brightness(1)';
          this.style.boxShadow = '';
          
          const foodItem = this.querySelector('.food-item');
          if (foodItem) {
              foodItem.style.animation = '';
          }
      });
      
      plate.addEventListener('click', function() {
          // Plate flip animation
          this.style.animation = 'plateFlip 1s ease';
          setTimeout(() => {
              this.style.animation = '';
          }, 1000);
      });
  });
  
  // Wine glass interactions
  glasses.forEach(glass => {
      glass.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-5px) scale(1.1)';
          
          const liquid = this.querySelector('.wine-liquid');
          if (liquid) {
              liquid.style.animation = 'liquidSwirl 2s ease infinite';
          }
          
          // Glass clink sound effect (visual)
          this.style.filter = 'brightness(1.4) drop-shadow(0 5px 15px rgba(220, 20, 60, 0.6))';
      });
      
      glass.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0) scale(1)';
          this.style.filter = 'brightness(1)';
          
          const liquid = this.querySelector('.wine-liquid');
          if (liquid) {
              liquid.style.animation = '';
          }
      });
  });
  
  // Candle interaction
  if (candle) {
      candle.addEventListener('mouseenter', function() {
          const flame = this.querySelector('.candle-flame');
          const glow = this.querySelector('.candle-glow');
          
          flame.style.animation = 'flameIntense 0.5s ease infinite';
          glow.style.transform = 'translateX(-50%) scale(1.5)';
          glow.style.opacity = '1';
      });
      
      candle.addEventListener('mouseleave', function() {
          const flame = this.querySelector('.candle-flame');
          const glow = this.querySelector('.candle-glow');
          
          flame.style.animation = 'flicker 1.5s infinite ease-in-out';
          glow.style.transform = 'translateX(-50%) scale(1)';
          glow.style.opacity = '0.6';
      });
  }
  
  // ============ DYNAMIC LIGHTING SYSTEM ============
  
  // Dynamic ambient lighting based on time
  function updateAmbientLighting() {
      const hour = new Date().getHours();
      const hero = document.querySelector('.hero');
      const gradientOverlay = document.querySelector('.gradient-overlay');
      
      if (hour >= 6 && hour < 12) {
          // Morning
          gradientOverlay.style.background = `linear-gradient(
              135deg,
              rgba(255, 215, 0, 0.3) 0%,
              rgba(255, 165, 0, 0.4) 25%,
              rgba(255, 140, 0, 0.3) 50%,
              rgba(255, 69, 0, 0.2) 75%,
              rgba(255, 99, 71, 0.3) 100%
          )`;
      } else if (hour >= 12 && hour < 18) {
          // Afternoon
          gradientOverlay.style.background = `linear-gradient(
              135deg,
              rgba(0, 191, 255, 0.3) 0%,
              rgba(30, 144, 255, 0.4) 25%,
              rgba(70, 130, 180, 0.3) 50%,
              rgba(100, 149, 237, 0.2) 75%,
              rgba(135, 206, 235, 0.3) 100%
          )`;
      } else {
          // Evening/Night
          gradientOverlay.style.background = `linear-gradient(
              135deg,
              rgba(25, 25, 112, 0.5) 0%,
              rgba(75, 0, 130, 0.6) 25%,
              rgba(138, 43, 226, 0.5) 50%,
              rgba(148, 0, 211, 0.4) 75%,
              rgba(199, 21, 133, 0.5) 100%
          )`;
          hero.style.setProperty('--ambient-light', 'rgba(25, 25, 112, 0.15)');
          document.documentElement.style.setProperty('--glow-color', 'rgba(138, 43, 226, 0.6)');
      }
      
      // Add a subtle animation when the gradient changes
      gradientOverlay.style.transition = 'background 2s ease-in-out';
      setTimeout(() => {
          gradientOverlay.style.transition = 'none';
      }, 2000);
  }
  
  // Initialize lighting and update every hour
  updateAmbientLighting();
  setInterval(updateAmbientLighting, 3600000); // Update every hour

}); // End of DOMContentLoaded

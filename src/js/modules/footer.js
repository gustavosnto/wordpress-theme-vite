/**
 * Footer Interactions
 * Handles back-to-top button, newsletter form, and footer animations
 */

export default function initFooter() {
  // Back to top button functionality
  const backToTopBtn = document.getElementById("back-to-top");

  if (backToTopBtn) {
    // Show/hide button based on scroll position
    const toggleBackToTopButton = () => {
      const scrollTop =
        window.pageYOffset || document.documentElement.scrollTop;

      if (scrollTop > 300) {
        backToTopBtn.classList.add("visible");
      } else {
        backToTopBtn.classList.remove("visible");
      }
    };

    // Smooth scroll to top
    const scrollToTop = () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    };

    // Event listeners
    window.addEventListener("scroll", toggleBackToTopButton);
    backToTopBtn.addEventListener("click", scrollToTop);

    // Initial check
    toggleBackToTopButton();
  }

  // Newsletter form enhancement
  const newsletterForm = document.querySelector(".newsletter-form form");

  if (newsletterForm) {
    const emailInput = newsletterForm.querySelector('input[type="email"]');
    const submitButton = newsletterForm.querySelector('button[type="submit"]');

    // Add loading state to submit button
    const setLoadingState = (loading) => {
      if (loading) {
        submitButton.innerHTML =
          '<i class="fas fa-spinner fa-spin"></i> Enviando...';
        submitButton.disabled = true;
      } else {
        submitButton.innerHTML =
          '<i class="fas fa-paper-plane"></i> Inscrever-se';
        submitButton.disabled = false;
      }
    };

    // Enhanced form validation
    const validateEmail = (email) => {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    };

    // Form submission handler
    newsletterForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      const email = emailInput.value.trim();

      if (!validateEmail(email)) {
        showNotification("Por favor, insira um email válido.", "error");
        emailInput.focus();
        return;
      }

      setLoadingState(true);

      try {
        // Here you would typically send the data to your server
        // For now, we'll simulate a successful submission
        await new Promise((resolve) => setTimeout(resolve, 1500));

        showNotification("Obrigado! Você foi inscrito com sucesso.", "success");
        emailInput.value = "";
      } catch (error) {
        showNotification("Erro ao se inscrever. Tente novamente.", "error");
      } finally {
        setLoadingState(false);
      }
    });

    // Real-time email validation
    emailInput.addEventListener("blur", () => {
      const email = emailInput.value.trim();
      if (email && !validateEmail(email)) {
        emailInput.style.borderColor = "#ef4444";
        showNotification("Email inválido", "error");
      } else {
        emailInput.style.borderColor = "";
      }
    });
  }

  // Social media link tracking (optional analytics)
  const socialLinks = document.querySelectorAll(".social-links a");

  socialLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      const platform = link.classList.contains("facebook")
        ? "Facebook"
        : link.classList.contains("twitter")
        ? "Twitter"
        : link.classList.contains("linkedin")
        ? "LinkedIn"
        : link.classList.contains("instagram")
        ? "Instagram"
        : "Social";

      console.log(`Social media click: ${platform}`);

      // Here you could add analytics tracking
      // gtag('event', 'social_click', { platform: platform });
    });
  });

  // Animate footer elements on scroll
  const observeFooterElements = () => {
    const footer = document.querySelector(".site-footer");
    if (!footer) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            footer.classList.add("animate-in");

            // Stagger animation for footer columns
            const columns = footer.querySelectorAll(".footer-column");
            columns.forEach((column, index) => {
              setTimeout(() => {
                column.style.opacity = "1";
                column.style.transform = "translateY(0)";
              }, index * 150);
            });
          }
        });
      },
      {
        threshold: 0.1,
      }
    );

    observer.observe(footer);

    // Initial setup for columns
    const columns = footer.querySelectorAll(".footer-column");
    columns.forEach((column) => {
      column.style.opacity = "0";
      column.style.transform = "translateY(30px)";
      column.style.transition = "all 0.6s ease";
    });
  };

  // Initialize footer animations
  observeFooterElements();

  // Add smooth hover effects to rating stars
  const ratingStars = document.querySelectorAll(".rating-stars .star");

  ratingStars.forEach((star, index) => {
    star.addEventListener("mouseenter", () => {
      // Light up stars up to the hovered one
      ratingStars.forEach((s, i) => {
        if (i <= index) {
          s.style.color = "#fbbf24";
        } else {
          s.style.color = "#6b7280";
        }
      });
    });
  });

  // Reset stars on mouse leave
  const ratingContainer = document.querySelector(".rating-stars");
  if (ratingContainer) {
    ratingContainer.addEventListener("mouseleave", () => {
      ratingStars.forEach((star) => {
        star.style.color = "#fbbf24"; // Reset to default gold color
      });
    });
  }
}

// Notification system
function showNotification(message, type = "info") {
  // Remove existing notifications
  const existingNotification = document.querySelector(".footer-notification");
  if (existingNotification) {
    existingNotification.remove();
  }

  // Create notification element
  const notification = document.createElement("div");
  notification.className = `footer-notification ${type}`;
  notification.style.cssText = `
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 12px 20px;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    z-index: 1000;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    max-width: 300px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  `;

  // Set background color based on type
  if (type === "success") {
    notification.style.background = "linear-gradient(135deg, #10b981, #059669)";
  } else if (type === "error") {
    notification.style.background = "linear-gradient(135deg, #ef4444, #dc2626)";
  } else {
    notification.style.background = "linear-gradient(135deg, #3b82f6, #1d4ed8)";
  }

  notification.textContent = message;
  document.body.appendChild(notification);

  // Animate in
  setTimeout(() => {
    notification.style.transform = "translateX(0)";
  }, 10);

  // Auto remove after 4 seconds
  setTimeout(() => {
    notification.style.transform = "translateX(400px)";
    setTimeout(() => {
      notification.remove();
    }, 300);
  }, 4000);
}

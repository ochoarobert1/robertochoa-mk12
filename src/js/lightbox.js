document.addEventListener('DOMContentLoaded', function () {
  const galleryImages = document.querySelectorAll(
    '.wp-block-gallery .wp-block-image img'
  );

  if (galleryImages.length === 0) return;

  let currentIndex = 0;

  // Create lightbox
  const lightbox = document.createElement('div');
  lightbox.className = 'lightbox flex items-center justify-center hidden';
  lightbox.innerHTML = '<span class="prev">&lt;</span><img><span class="next">&gt;</span><span class="close">&times;</span>';
  document.body.appendChild(lightbox);

  const lightboxImg = lightbox.querySelector('img');
  const closeBtn = lightbox.querySelector('.close');
  const prevBtn = lightbox.querySelector('.prev');
  const nextBtn = lightbox.querySelector('.next');

  const showImage = (index) => {
    lightboxImg.src = galleryImages[index].src;
    currentIndex = index;
  };

  // Add click handlers to gallery images
  galleryImages.forEach((img, index) => {
    img.addEventListener('click', () => {
      showImage(index);
      lightbox.classList.remove('hidden');
    });
  });

  // Navigation
  prevBtn.addEventListener('click', () => {
    currentIndex = currentIndex > 0 ? currentIndex - 1 : galleryImages.length - 1;
    showImage(currentIndex);
  });

  nextBtn.addEventListener('click', () => {
    currentIndex = currentIndex < galleryImages.length - 1 ? currentIndex + 1 : 0;
    showImage(currentIndex);
  });

  // Close lightbox
  const closeLightbox = () => lightbox.classList.add('hidden');
  closeBtn.addEventListener('click', closeLightbox);
  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) closeLightbox();
  });

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('hidden')) {
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowLeft') prevBtn.click();
      if (e.key === 'ArrowRight') nextBtn.click();
    }
  });
});

document.addEventListener('DOMContentLoaded', () => {
  window.addEventListener('scroll', () => {
    const currHeaderHeight = document.getElementById('mainHeader').clientHeight;
    if (window.scrollY > 105) {
      document.getElementById('mainHeader').classList.add('main-header-fixed');
      document
        .getElementById('mainRow')
        .setAttribute('style', `padding-top: ${currHeaderHeight}px;`);
    } else {
      document
        .getElementById('mainHeader')
        .classList.remove('main-header-fixed');
      document
        .getElementById('mainRow')
        .setAttribute('style', 'padding-top: 0px;');
    }
  });
  window.addEventListener('resize', () => {
    const currHeaderWidth = document.getElementById('mainHeader').clientWidth;
    if (currHeaderWidth > 768) {
      document
        .getElementById('mobileMenu')
        .classList.remove('mobile-menu-container-open');
      document.getElementById('hamburger').classList.remove('open');
    }
  });
});

document.getElementById('hamburger').addEventListener('click', (e) => {
  e.preventDefault();
  document.getElementById('hamburger').classList.toggle('open');
  document
    .getElementById('mobileMenu')
    .classList.toggle('mobile-menu-container-open');
});

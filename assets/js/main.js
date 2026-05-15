// Reveal on scroll
document.addEventListener('DOMContentLoaded', () => {
  const els = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(en => { if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); } });
  }, { threshold: .12 });
  els.forEach(el => io.observe(el));

  // Active nav link
  const path = location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.tx-navbar .nav-link').forEach(a => {
    const href = a.getAttribute('href');
    if (href && href === path) a.classList.add('active');
  });

  // Form loading state
  document.querySelectorAll('form[data-loading]').forEach(f => {
    f.addEventListener('submit', () => {
      const btn = f.querySelector('button[type=submit]');
      if (btn) { btn.disabled = true; btn.innerHTML = '<span class="loader"></span> Submitting...'; }
    });
  });
});

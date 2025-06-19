<!-- EVOLUSOM - Bibliotecas de Animação -->

<!-- AOS - Animate On Scroll -->
<link rel="stylesheet" href="<?= URL_BASE ?>vendors/aos/aos.css">

<!-- Lightbox2 - Galeria de Imagens -->
<link rel="stylesheet" href="<?= URL_BASE ?>vendors/lightbox2/lightbox.min.css">

<!-- SweetAlert2 - Notificações -->
<link rel="stylesheet" href="<?= URL_BASE ?>vendors/sweetalert2/sweetalert2.min.css">

<!-- Scripts das Bibliotecas -->
<script src="<?= URL_BASE ?>vendors/aos/aos.js"></script>
<script src="<?= URL_BASE ?>vendors/lightbox2/lightbox.min.js"></script>
<script src="<?= URL_BASE ?>vendors/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= URL_BASE ?>vendors/particles/tsparticles.bundle.min.js"></script>
<script src="<?= URL_BASE ?>vendors/gsap/gsap.min.js"></script>

<!-- Sistema de Animações Customizado -->
<script src="<?= URL_BASE ?>assets/js/animacoes.js"></script>

<script>
// Configuração global das bibliotecas
document.addEventListener('DOMContentLoaded', function() {
    // Inicializa AOS se disponível
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    }

    // Configuração do Lightbox2
    if (typeof lightbox !== 'undefined') {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Imagem %1 de %2',
            'fadeDuration': 300,
            'imageFadeDuration': 300
        });
    }

    console.log('🚀 Bibliotecas Evolusom carregadas!');
});
</script> 
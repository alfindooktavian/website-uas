function nextSlide() {
    var currentSlide = document.querySelector('.carousel-item.active');
    var nextSlide = currentSlide.nextElementSibling || document.querySelector('.carousel-inner').firstElementChild;
    currentSlide.classList.remove('active');
    nextSlide.classList.add('active');
    updateIndicators();
}

function prevSlide() {
    var currentSlide = document.querySelector('.carousel-item.active');
    var prevSlide = currentSlide.previousElementSibling || document.querySelector('.carousel-inner').lastElementChild;
    currentSlide.classList.remove('active');
    prevSlide.classList.add('active');
    updateIndicators();
}

document.querySelector('.carousel-control-next').addEventListener('click', nextSlide);
document.querySelector('.carousel-control-prev').addEventListener('click', prevSlide);

// Fungsi untuk mengubah indikator aktif
function updateIndicators() {
    var indicators = document.querySelectorAll('.carousel-indicators li');
    var activeSlide = document.querySelector('.carousel-item.active');
    var activeIndex = Array.from(activeSlide.parentNode.children).indexOf(activeSlide);

    indicators.forEach(function(indicator, index) {
        if (index === activeIndex) {
            indicator.classList.add('active');
        } else {
            indicator.classList.remove('active');
        }
    });
}

// Tambahkan event listener ke carousel setelah halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan event listener untuk event slide carousel
    var myCarousel = document.querySelector('#myCarousel');
    myCarousel.addEventListener('slid.bs.carousel', updateIndicators);

    // Panggil fungsi pertama kali untuk menginisialisasi indikator
    updateIndicators();

    // Atur interval untuk mengganti slide setiap 15 detik
    setInterval(nextSlide, 5000);
});

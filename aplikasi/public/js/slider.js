function nextSlide() {
    var currentSlide = document.querySelector('.carousel-item.active');
    var nextSlide = currentSlide.nextElementSibling || document.querySelector('.carousel-inner').firstElementChild;
    currentSlide.classList.remove('active');
    nextSlide.classList.add('active');
}

function prevSlide() {
    var currentSlide = document.querySelector('.carousel-item.active');
    var prevSlide = currentSlide.previousElementSibling || document.querySelector('.carousel-inner').lastElementChild;
    currentSlide.classList.remove('active');
    prevSlide.classList.add('active');
}

document.querySelector('.carousel-control-next').addEventListener('click', nextSlide);
document.querySelector('.carousel-control-prev').addEventListener('click', prevSlide);

setInterval(nextSlide, 5000); // Otomatis ganti slide setiap 15 detik

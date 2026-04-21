document.addEventListener("DOMContentLoaded", () => {
  let currentSlide = 0;

  const slides = document.getElementById("slides");
  const slidesList = document.querySelectorAll(".slide");
  const nextBtn = document.querySelector(".slider-btn.right");
  const prevBtn = document.querySelector(".slider-btn.left");

  function showSlide(index) {
    const maxSlides = 6;

    if (index >= maxSlides) {
      currentSlide = 0;
    } else if (index < 0) {
      currentSlide = maxSlides - 1;
    } else {
      currentSlide = index;
    }

    slides.style.transform = `translateX(-${currentSlide * 100}%)`;
  }

  function nextSlide() {
    showSlide(currentSlide + 1);
  }

  function prevSlide() {
    showSlide(currentSlide - 1);
  }

  // ✅ Button events
  nextBtn.addEventListener("click", nextSlide);
  prevBtn.addEventListener("click", prevSlide);

  // ✅ Auto slide
  setInterval(nextSlide, 3000);
});

//GAllery
let index = 0;

const wrapper = document.querySelector(".slides-wrapper");
const Slides = document.querySelectorAll(".Customslide");

const maxSlides = 3;

document.querySelector(".next").onclick = () => {
  index = (index + 1) % maxSlides;
  updateSlider();
};

document.querySelector(".prev").onclick = () => {
  index = (index - 1 + maxSlides) % maxSlides;
  updateSlider();
};

function updateSlider() {
  wrapper.style.transform = `translateX(-${index * 100}%)`;
}

//contactUs toogle
// contact toggle
function toggleContact() {
  const panel = document.getElementById("contactPanel");
  panel.classList.toggle("active");
}

document.addEventListener("DOMContentLoaded", () => {
  const panel = document.getElementById("contactPanel"); // ✅ use same selector

  function fixContactPanel() {
    if (window.innerWidth <= 768) {
      panel.classList.remove("active"); // force close on mobile
    }
  }

  // Run on load
  fixContactPanel();

  // Run on resize
  window.addEventListener("resize", fixContactPanel);
});

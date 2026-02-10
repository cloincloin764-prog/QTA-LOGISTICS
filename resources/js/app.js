import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const heroData = [
    {
        image: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop",
        title: "Fast and Sustainable Logistic Solution",
        desc: "Delivering goods quickly from origin to destination.",
    },
    {
        image: "https://images.unsplash.com/photo-1494412574643-35d32469f425?q=80&w=2070&auto=format&fit=crop",
        title: "Global Cargo Transportation",
        desc: "Reliable international freight services worldwide.",
    }
];

const cardData = [
    {
        text: "We have all kinds of transport solutions",
        img: "https://images.unsplash.com/photo-1494412574643-35d32469f425?q=80&w=400"
    },
    {
        text: "Safe and Secure Cargo Handling",
        img: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=400"
    }
];

let heroIndex = 0;
let cardIndex = 0;

const heroSlides = document.getElementById("heroSlides");
const heroTitle = document.getElementById("heroTitle");
const heroDesc = document.getElementById("heroDesc");
const cardSlider = document.getElementById("cardSlider");

function renderHero() {
    heroSlides.style.backgroundImage = `url(${heroData[heroIndex].image})`;
    heroSlides.className = "absolute inset-0 bg-cover bg-center transition-all duration-700";

    heroTitle.innerText = heroData[heroIndex].title;
    heroDesc.innerText = heroData[heroIndex].desc;
}

function renderCard() {
    cardSlider.innerHTML = `
        <div class="flex gap-6 items-center">
            <img src="${cardData[cardIndex].img}" class="w-32 h-32 object-cover rounded-2xl"/>
            <div>
                <p class="text-white text-xl mb-4">${cardData[cardIndex].text}</p>
                <a href="#" class="text-orange-400">Learn more →</a>
            </div>
        </div>
    `;
}

document.getElementById("nextHero").onclick = () => {
    heroIndex = (heroIndex + 1) % heroData.length;
    renderHero();
};

document.getElementById("nextCard").onclick = () => {
    cardIndex = (cardIndex + 1) % cardData.length;
    renderCard();
};

renderHero();
renderCard();

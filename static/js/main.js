// Mobile Menu
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const navLinks = document.getElementById('nav-links');

    if (mobileMenuButton && navLinks) {
        mobileMenuButton.addEventListener('click', function() {
            navLinks.classList.toggle('hidden');
        });
    }
});

/* INDEX */

// Initialize Variables
let currentIndex = 0;
const imgDesktop = document.getElementById('hero-img-desktop');
const imgMobile = document.getElementById('hero-img-mobile');
const title = document.getElementById('hero-title');
const desc = document.getElementById('hero-desc');
const cta = document.getElementById('hero-cta');
const dotsContainer = document.getElementById('dots-container');

// Update Slide Data
function updateSlide(index) {
    currentIndex = index;
    imgDesktop.src = slides[index].desktop;
    imgMobile.src = slides[index].mobile;
    imgDesktop.alt = slides[index].title;
    imgMobile.alt = slides[index].title;
    title.innerText = slides[index].title;
    desc.innerText = slides[index].desc;

    const link = slides[index].ctaLink;
    
    if (link && link.trim() !== "") {
        cta.classList.remove('hidden');
        cta.href = link;
        cta.target = link.startsWith('http') ? '_blank' : '_self';
    } else {
        cta.classList.add('hidden'); 
    }

    document.querySelectorAll('.dot').forEach((dot, i) => {
        dot.classList.toggle('bg-white', i === index);
        dot.classList.toggle('bg-gray-400', i !== index);
    });
}

if (imgDesktop && slides && slides.length > 0) {
    updateSlide(0);

    // Render Pagination Dots
    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = `dot w-3 h-3 rounded-full transition-all ${i === 0 ? 'bg-white' : 'bg-gray-400'}`;
        dot.onclick = () => {
            updateSlide(i);
            resetAutoSlide();
        };
        dotsContainer.appendChild(dot);
    });

    // Handle Slide Button
    document.getElementById('next-btn').onclick = () => {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlide(currentIndex);
        resetAutoSlide();
    };

    document.getElementById('prev-btn').onclick = () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateSlide(currentIndex);
        resetAutoSlide();
    };

    // Manage Auto Slide
    let autoSlideInterval;

    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlide(currentIndex);
        }, 20000);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    startAutoSlide();

    // Handle Touch Gestures
    let touchstartX = 0;
    let touchendX = 0;
    const heroSection = document.getElementById('hero-section');

    if (heroSection) {
        heroSection.addEventListener('touchstart', e => {
            touchstartX = e.changedTouches[0].screenX;
        });

        heroSection.addEventListener('touchend', e => {
            touchendX = e.changedTouches[0].screenX;
            handleGesture();
        });
    }

    function handleGesture() {
        if (touchendX < touchstartX - 50) {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlide(currentIndex);
            resetAutoSlide();
        }

        if (touchendX > touchstartX + 50) {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateSlide(currentIndex);
            resetAutoSlide();
        }
    }
}

// Initialize Swiper
if (document.querySelector('.partner-swiper')) {
    const swiper = new Swiper('.partner-swiper', {
        loop: true,
        spaceBetween: 30,
        centeredSlides: true,
        speed: 2000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        grabCursor: true,
        slidesPerView: 2,
        breakpoints: {
            640: { slidesPerView: 3 },
            768: { slidesPerView: 4 },
            1024: { slidesPerView: 6 },
        },
    });
}

// Handle User Reviews
const revImg = document.getElementById('review-img');
const revText = document.getElementById('review-text');
const revName = document.getElementById('review-name');

if (revImg && reviews && reviews.length > 0) {
    let reviewIdx = 0;

    function updateReview(i) {
        revImg.src = reviews[i].img;
        revName.innerText = reviews[i].name;
        revText.innerText = `"${reviews[i].text}"`;
    }

    updateReview(0);

    document.getElementById('review-next').onclick = () => {
        reviewIdx = (reviewIdx + 1) % reviews.length;
        updateReview(reviewIdx);
    };

    document.getElementById('review-prev').onclick = () => {
        reviewIdx = (reviewIdx - 1 + reviews.length) % reviews.length;
        updateReview(reviewIdx);
    };
}

/* ABOUT */

// Executive Team Slider
let currentDirectorSlide = 0;
const directorSlides = document.querySelectorAll('.director-slide');
const directorDots = document.querySelectorAll('.director-dot');

function showDirectorSlide(index) {
    directorSlides.forEach((slide, i) => {
        if (i === index) {
            slide.classList.remove('hidden');
        } else {
            slide.classList.add('hidden');
        }
    });
    directorDots.forEach((dot, i) => {
        if (i === index) {
            dot.classList.remove('bg-gray-300', 'w-3');
            dot.classList.add('bg-orange-500', 'w-10');
        } else {
            dot.classList.remove('bg-orange-500', 'w-10');
            dot.classList.add('bg-gray-300', 'w-3');
        }
    });
    currentDirectorSlide = index;
}

function switchDirectorSlide(index) {
    showDirectorSlide(index);
}

function nextDirectorSlide() {
    let next = (currentDirectorSlide + 1) % directorSlides.length;
    showDirectorSlide(next);
}

function prevDirectorSlide() {
    let prev = (currentDirectorSlide - 1 + directorSlides.length) % directorSlides.length;
    showDirectorSlide(prev);
}

/* PRODUCTS */

// Product Slider
let currentModalIndex = 0;
const productSlider = document.getElementById('product-slider');
const modal = document.getElementById('productModal');

// Handle Slider Scroll (Horizontal)
function scrollSlider(direction) {
    if (productSlider) {
        const scrollAmount = productSlider.clientWidth;
        if (direction === 'left') {
            productSlider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            productSlider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
}

// Product Modal
window.scrollSlider = scrollSlider;

if (modal && typeof allProducts !== 'undefined') {
    window.openProductModal = function(productId) {
        currentModalIndex = allProducts.findIndex(p => p.id === productId);
        updateModalContent();
        modal.classList.remove('hidden');
    };

    window.closeProductModal = function() {
        modal.classList.add('hidden');
    };

    modal.addEventListener('click', (e) => {
        if (e.target === modal) window.closeProductModal();
    });

    function updateModalContent() {
        const prod = allProducts[currentModalIndex];
        const modalImg = document.getElementById('modal-img');
        const modalTitle = document.getElementById('modal-title');
        const modalPrice = document.getElementById('modal-price');
        const modalDesc = document.getElementById('modal-desc');

        if (modalImg) modalImg.src = prod.image;
        if (modalTitle) modalTitle.innerText = prod.name;
        if (modalPrice) modalPrice.innerText = prod.price;
        if (modalDesc) modalDesc.innerText = prod.desc;
    }

    window.nextProduct = function(e) {
        e.stopPropagation();
        currentModalIndex = (currentModalIndex + 1) % allProducts.length;
        updateModalContent();
    };

    window.prevProduct = function(e) {
        e.stopPropagation();
        currentModalIndex = (currentModalIndex - 1 + allProducts.length) % allProducts.length;
        updateModalContent();
    };
}

/* BLOG FILTER */

// Disable Scroll
if ('scrollRestoration' in history) { history.scrollRestoration = 'manual'; }

// Initialize States
let currentCategory = sessionStorage.getItem('blogCat') || 'all';
let currentPage = parseInt(sessionStorage.getItem('blogPage')) || 1;
let currentSearch = sessionStorage.getItem('blogSearch') || '';

// Set Search Input
const searchInput = document.getElementById('search-input');
if (searchInput) {
    searchInput.value = currentSearch;
}

// Apply Style (Active)
function applyActiveStyle(cat) {
    document.querySelectorAll('.filter-btn').forEach(b => {
        const btnText = b.innerText.trim().toLowerCase();
        const targetCat = cat.toLowerCase();

        if ((targetCat === 'all' && btnText === 'all') || btnText === targetCat) {
            b.classList.add('active', 'bg-orange-500', 'text-white', 'border-orange-500');
            b.classList.remove('hover:border-orange-500', 'hover:text-orange-600');
        } else {
            b.classList.remove('active', 'bg-orange-500', 'text-white', 'border-orange-500');
            b.classList.add('hover:border-orange-500', 'hover:text-orange-600');
        }
    });
}

// Save Session State
function saveState(page, cat, search) {
    sessionStorage.setItem('blogPage', page);
    sessionStorage.setItem('blogCat', cat);
    sessionStorage.setItem('blogSearch', search);
}

// Load Blog Data
function loadBlog(page) {
    currentPage = page;
    const searchField = document.getElementById('search-input');
    currentSearch = searchField ? searchField.value : '';
    const grid = document.getElementById('blog-grid');

    if (!grid) return;

    fetch(`blog-filter.php?page=${page}&category=${encodeURIComponent(currentCategory)}&search=${encodeURIComponent(currentSearch)}`)
        .then(response => response.text())
        .then(html => {
            grid.innerHTML = html;
            saveState(page, currentCategory, currentSearch);

            if (sessionStorage.getItem('scrollToFilter') === 'true') {
                sessionStorage.removeItem('scrollToFilter');
                setTimeout(() => {
                    const filterSection = document.getElementById('filter-section');
                    if (filterSection) {
                        filterSection.scrollIntoView({ behavior: 'smooth' });
                    }
                }, 200);
            }
        })
        .catch(err => {
            grid.innerHTML = '<p class="col-span-full text-center py-10 text-red-500">Failed to load data!</p>';
        });
}

// Set Category (Active)
function setCategory(cat, btn) {
    currentCategory = cat;
    applyActiveStyle(cat);
    loadBlog(1);
}

// Debounce Search Input
let timer;
function debounceSearch() {
    clearTimeout(timer);
    timer = setTimeout(() => {
        loadBlog(1);
    }, 200);
}

// Window Load
window.onload = () => {
    if (document.getElementById('blog-grid')) {
        applyActiveStyle(currentCategory);
        loadBlog(currentPage);
    }
};

// Handle Browser Back
window.addEventListener('pageshow', (event) => {
    if (event.persisted && document.getElementById('blog-grid')) {
        currentCategory = sessionStorage.getItem('blogCat') || 'all';
        currentPage = parseInt(sessionStorage.getItem('blogPage')) || 1;
        currentSearch = sessionStorage.getItem('blogSearch') || '';
        const searchField = document.getElementById('search-input');
        if (searchField) searchField.value = currentSearch;
        
        applyActiveStyle(currentCategory);
        loadBlog(currentPage);
    }
});

// Bind Function Object (onclick/onkeyup)
window.setCategory = setCategory;
window.debounceSearch = debounceSearch;
window.loadBlog = loadBlog;


/* BLOG DETAIL */

// Style Content Editor
document.querySelectorAll('.content-editor a').forEach(link => {
    link.setAttribute('target', '_blank');
    link.setAttribute('rel', 'noopener noreferrer');
});

/* CAREER */

// Toggle Job Description
function toggleAccordion(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('i');

    if (!content || !icon) return;

    content.classList.toggle('hidden');

    if (content.classList.contains('hidden')) {
        icon.style.transform = 'rotate(0deg)';
    } else {
        icon.style.transform = 'rotate(90deg)';
    }
}

// Pop-up Apply
function openModal(title) {
    const hiddenJobTitle = document.getElementById('hiddenJobTitle');
    const applicationModal = document.getElementById('applicationModal');
    
    if (hiddenJobTitle) hiddenJobTitle.value = title;
    if (applicationModal) applicationModal.classList.remove('hidden');
}

function closeModal() {
    const applicationModal = document.getElementById('applicationModal');
    if (applicationModal) applicationModal.classList.add('hidden');
}

// Close Modal
if (applicationModal) {
    applicationModal.addEventListener('click', (e) => {
        if (e.target === applicationModal) {
            window.closeModal();
        }
    });
}

// Bind Function Object (onclick)
window.toggleAccordion = toggleAccordion;
window.openModal = openModal;
window.closeModal = closeModal;
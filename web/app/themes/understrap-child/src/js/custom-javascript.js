import { tns } from 'tiny-slider/src/tiny-slider';
import { Carousel, Popover } from 'bootstrap';

import './components/offcanvas';

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        document.body.classList.remove('preload');
    }, 500);
    const style = getComputedStyle(document.body);

    // document.addEventListener('scroll', () => {
    //     setNavbarStyle();
    // })

    // const setNavbarStyle = () => {
    //     const navbar= document.querySelector('#main-nav');

    //     if( window.scrollY > 0 ) {
    //         navbar.style.setProperty('--codeit-navbar-color', style.getPropertyValue('--codeit-white'));
    //         navbar.style.setProperty('--codeit-navbar-hover-color', style.getPropertyValue('--codeit-white'));
    //         navbar.style.setProperty('--codeit-navbar-brand-color', style.getPropertyValue('--codeit-white'));
    //         navbar.style.setProperty('--codeit-navbar-brand-hover-color', style.getPropertyValue('--codeit-white'));

    //         navbar.style.backgroundColor = style.getPropertyValue('--codeit-dark');
    //     } else {
    //         /**
    //          * This style is applied when navbar is at the top
    //          */
    //         navbar.style.setProperty('--codeit-navbar-color', style.getPropertyValue('--codeit-white'));
    //         navbar.style.setProperty('--codeit-navbar-hover-color', style.getPropertyValue('--codeit-white'));
    //         navbar.style.setProperty('--codeit-navbar-brand-color', style.getPropertyValue('--codeit-white'));
    //         navbar.style.setProperty('--codeit-navbar-brand-hover-color', style.getPropertyValue('--codeit-white'));

    //         navbar.style.backgroundColor = 'transparent';
    //         navbar.style.borderBottom = 'none';
    //     }
    // }

    // setNavbarStyle();

    const sliderExists = document.querySelector('.slider');
    const carouselExists = document.querySelector('.b-carousel');

    if (sliderExists) {
        tns({
            container: '.slider',
            items: 2,
            autoplay: false,
            nav: false,
            controlsContainer: '.slider-controls',
            gutter: '15px'
        });
    }

    if (carouselExists) {
        tns({
            container: '.b-carousel',
            mode: 'gallery',
            items: 1,
            autoplay: false,
            nav: false,
            controlsContainer: '.b-carousel-controls'
        });
    }

    const carouselEl = document.getElementById('bs-carousel')
    
    if( carouselEl ) {
        const carousel = new Carousel('#bs-carousel');
        const carouselCountCurrentEl = document.querySelector('.carousel-count-current');
    
        carousel._element.addEventListener('slide.bs.carousel', event => {
            carouselCountCurrentEl.innerText = event.to + 1;
        })
    }

    const offcanvasOpenBtns = document.querySelectorAll('[data-offcanvas-open]');

    [...offcanvasOpenBtns]?.forEach(btn => btn.addEventListener('click', () => {
        /** @type {HTMLElement} */
        const target = document.querySelector(btn.dataset.offcanvasOpen);

        target?.setAttribute('open', 'true');
    }));

    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new Popover(popoverTriggerEl, { trigger: 'hover focus' }))
})
import { tns } from 'tiny-slider/src/tiny-slider';
import { Carousel } from 'bootstrap';
import AOS from 'aos';

import './components/offcanvas';
import './components/modal';

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        document.body.classList.remove('preload');
        AOS.init({
           once: true
        });
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

    const openComponentsElements = document.querySelectorAll('[data-offcanvas-open], [data-modal-open]');

    [...openComponentsElements]?.forEach(element => element.addEventListener('click', () => {
        /** @type {HTMLElement} */
        const target = document.querySelector(element.dataset.offcanvasOpen ?? element.dataset.modalOpen);
        console.log(target)
        element?.classList.toggle('active');
        target?.setAttribute('open', 'true');
    }));
})
import Glide from '@glidejs/glide';
import { tns } from 'tiny-slider/src/tiny-slider';

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

    const slider = tns({
        container: '.slider',
        items: 2,
        autoplay: false,
        nav: false,
        controlsContainer: '.slider-controls',
        gutter: '15px'
    });
})
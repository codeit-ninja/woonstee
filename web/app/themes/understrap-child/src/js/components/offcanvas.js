class WcOffcanvas extends HTMLElement {
    static observedAttributes = ['open'];

    #shadow;

    constructor() {
        super();
    }
    
    connectedCallback() {
        document.addEventListener('DOMContentLoaded', this.onMount.bind(this));
        document.body.classList.add('has-offcanvas')
    }

    onMount() {
        const closeBtn = this.querySelector('.offcanvas-btn-close')

        closeBtn?.addEventListener('click', () => this.setAttribute('open', 'false'))
    }

    close() {
        document.body.classList.remove('offcanvas-open')
        document.body.classList.add('offcanvas-closed')

        const delay = getComputedStyle(this).getPropertyValue('--codeit-offcanvas-animation-delay')

        setTimeout(() => {
            document.body.classList.remove('offcanvas-closed')
            this.fixStickyLikeElements(true)
            document.body.style.removeProperty('overflow')
        }, parseFloat(delay) * 2000)
    }

    open() {
        // Position fixed wont work using css
        // Keep position at top of window using JS
        ['load', 'scroll'].forEach(event => window.addEventListener(event, () => this.style.top = `${window.scrollY}px`))

        this.style.top = `${window.scrollY}px`

        document.body.classList.remove('offcanvas-closed')
        document.body.classList.add('offcanvas-open')

        if( 'hidden' === this.getAttribute('body') ) {
            document.body.style.overflow = 'hidden'
        }
        
        this.fixStickyLikeElements()
    }

    fixStickyLikeElements(reset = false) {
        const fixedTop = document.getElementsByClassName('fixed-top');

        [...fixedTop].forEach(el => {
            el.style.position = 'absolute'
            el.style.top = `${window.scrollY}px`

            if( reset ) {
                el.style.removeProperty('position')
                el.style.removeProperty('top')
            }
        })
    }

    attributeChangedCallback(name, oldVal, newVal) {        
        if( 
            name === 'open' &&
            newVal === '' ||
            newVal === 'true'
        ) {
            this.open()
        }

        if( 
            name === 'open' &&
            newVal === 'false'
        ) {
            this.close()
        }
    }
}

window.customElements.define('wc-offcanvas', WcOffcanvas);
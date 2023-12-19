class WcModal extends HTMLElement {
    static observedAttributes = ['open'];
    
    connectedCallback() {
        document.addEventListener('DOMContentLoaded', this.onMount.bind(this))
        document.documentElement.classList.add('has-modal')

        this.createHeaderElement()
    }

    onMount() {
        const closeBtn = this.querySelector('.modal-close')

        closeBtn?.addEventListener('click', () => this.setAttribute('open', 'false'))
    }

    createHeaderElement() {
        const headerEl = document.createElement('div')
        
        headerEl.classList.add('modal-header')
        headerEl.innerHTML = `
            <button class="modal-close">
                <i class="fa-thin fa-xmark"></i>
                <span>sluiten</span>
            </button>
        `

        this.querySelector('.modal-container').prepend(headerEl)
    }

    close() {
        const activeElements = document.querySelectorAll('[data-modal-open].active')
        const delay = parseFloat(getComputedStyle(this).getPropertyValue('--codeit-modal-animation-duration')) * 2000;

        [...activeElements].forEach(activeEl => {
            activeEl.classList.remove('active', 'is-active');
        })

        document.documentElement.classList.add('modal-closing')

        setTimeout(() => {
            document.documentElement.classList.remove('modal-open')
            document.documentElement.classList.remove('modal-closing')
            document.documentElement.style.removeProperty('overflow')
        }, delay)
    }

    open() {
        document.documentElement.classList.remove('modal-closed')
        document.documentElement.classList.add('modal-open')
        document.documentElement.style.overflow = 'hidden'
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

window.customElements.define('wc-modal', WcModal);
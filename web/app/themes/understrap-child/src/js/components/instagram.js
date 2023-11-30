class WcInstagram extends HTMLElement {
    connectedCallback() {
        document.addEventListener( 'DOMContentLoaded', this.onMount.bind( this ) )

        this.getPosts()
    }

    async getPosts() {
        const request = await fetch( '/wp-json/api/v1/instagram/posts' )
        const response = await request.json()

        console.log(response)

        // Filter by images only and only get the first 4
        const medias = response.filter( media => ! media.video ).slice( 0, 4 )

        medias.forEach(media => this.append( new WcInstagramMedia( media ) ));
    } 

    onMount() {}
}

class WcInstagramMedia extends HTMLElement {
    static observedAttributes = ['open'];

    media;

    constructor( media ) {
        super()
        
        this.media = media;

        this.setAttribute( 'id', media.shortcode );
        this.render();
    }

    render() {
        this.innerHTML = `<img src="/app/uploads/instagram/${this.media.filename}" alt="${this.media.accessibilityCaption}" />`;
    }
}

window.customElements.define('wc-instagram', WcInstagram);
window.customElements.define('wc-instagram-media', WcInstagramMedia);
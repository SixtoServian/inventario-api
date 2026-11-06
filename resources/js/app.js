//

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

// Escucha el evento producto.actualizado en el canal inventario
window.Echo.channel('inventario')
    .listen('.producto.actualizado', (evento) => {
        console.log('Cambio recibido:', evento);
        // Reenvía el evento al DOM para que Blade reaccione
        window.dispatchEvent(new CustomEvent('inventario-cambio', { detail: evento }));
    });

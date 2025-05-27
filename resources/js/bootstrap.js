import $ from 'jquery'
import axios from 'axios';

import DataTable from 'laravel-datatables-vite';
import Alpine from 'alpinejs';
import 'laravel-datatables-vite';
import 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-select-bs5';

window.jQuery = window.$ = $;
window.axios = axios;
window.Alpine = Alpine;
window.DataTable = DataTable;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import '../../public/src/plugins/global/plugins.bundle.js';
import '../../public/src/js/scripts.bundle.js';
Alpine.start();

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

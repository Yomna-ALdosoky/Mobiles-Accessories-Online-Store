import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '35ccd80fdcc5eb418f5c', // الكي بتاعك مباشرة
    cluster: 'eu',
    forceTLS: true
});
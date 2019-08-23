/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('loader-component', require('./components/util/loaderComponent.vue').default);
Vue.component('tweet-component', require('./components/twitterApi/tweetComponent.vue').default);
Vue.component('tweet-container-component', require('./components/twitterApi/tweetContainerComponent.vue').default);
Vue.component('search-bar-component', require('./components/twitterApi/searchBarComponent.vue').default);
Vue.component('nav-bar-component', require('./components/twitterApi/navBarComponent.vue').default);
Vue.component('screen-name-component', require('./components/twitterApi/screenNameComponent.vue').default);
Vue.component('error-notification-component', require('./components/util/errorNotificationComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

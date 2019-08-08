/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./utils');

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

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('tooltip', require('./components/Tooltip.vue').default);
Vue.component('brand-prices', require('./components/BrandPrices.vue').default);
Vue.component('game-date-draw-picker', require('./components/GameDateDrawPicker').default);
Vue.component('filters-reset-button', require('./components/FiltersResetButton').default);
Vue.component('select-box', require('./components/SelectBox').default);
Vue.component('user-available-balance', require('./components/UserAvailableBalance').default);
Vue.component('brand-extra-games', require('./components/BrandExtraGames').default);
Vue.component('bet-status', require('./components/BetStatus').default);
Vue.component('user-status', require('./components/UserStatus').default);
Vue.component('count-down-timer', require('./components/CountDownTimer').default);
Vue.component('user-local-time', require('./components/UserLocalTime').default);
Vue.component('user-param-toggle', require('./components/UserParamToggle').default);
Vue.component('show-button', require('./components/ShowButton').default);
Vue.component('expandable-area', require('./components/ExpandableArea').default);
Vue.component('user-bets', require('./components/UserBets').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



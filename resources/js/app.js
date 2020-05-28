import './bootstrap' // CSRF対策用
import Vue from 'vue'
import jquery from 'jquery';
import './main';
import axios from 'axios';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// いいね機能
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const token = document.head.querySelector('meta[name="csrf-token"]')
if(token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('like',require('./components/Like.vue').default);
Vue.component('counter', require('./components/Counter.vue').default);
Vue.component('imagetest', require('./components/ImageTest.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
});

// ログインチェックしてからアプリを生成する
// const createApp = async () => {
//     //await store.dispatch('auth/currentUser')
//
//     new Vue({
//         el: '#app',
//         // router,
//         store,
//         components: { App },
//         template: '<App />'
//     })
// }
//
// createApp()
// const app = new Vue({
//     el: '#app',
//     // router, // ルーティングの定義を読み込む
//     // components: { App }, // ルートコンポーネントの使用を宣言する
//     // template: '<App />' // ルートコンポーネントを描画する
// });


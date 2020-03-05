import Vue from 'vue';
// import './main';
import axios from 'axios';
// ルーティングの定義をインポートする
// import router from './router'
// ルートコンポーネントをインポートする
// import App from './App.vue'
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

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('like',require('./components/Like.vue').default);
Vue.component('counter', require('./components/Counter.vue').default);
Vue.component('imagetest', require('./components/ImageTest.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    // router, // ルーティングの定義を読み込む
    // components: { App }, // ルートコンポーネントの使用を宣言する
    // template: '<App />' // ルートコンポーネントを描画する
});
// const app2 = new Vue({
//     el: '#app2',
// });
// new Vue({
//     el: '#file-preview',
//     data: {
//         imageData: '' //画像格納用変数
//     },
//     methods: {
//         onFileChange(e) {
//             // cosole.log('File');
//             const files = e.target.files;
//
//             if(files.length > 0) {
//
//                 const file = files[0];
//                 const reader = new FileReader();
//
//                 reader.onload = (e) => {
//                     this.imageData = e.target.result;
//
//                 };
//                 reader.readAsDataURL(file);
//             }
//         }
//     }
// });
//
// new Vue({
//     el: '#app2',
//     data: {
//         strLength: ""
//     },
//     computed: {
//         strCount: function() {
//             return this.strLength.length;
//         }
//     }
// })
// new Vue ({
//     el: '#img-prev',
//     data: {
//         uploadedImage: "",
//     },
//     methods: {
//         onFileChange(e) {
//             let files = e.target.files;
//             this.createImage(files[0]); //File情報格納
//         },
//         //アップロードした画像を表示
//         createImage(file) {
//             let reader = new FileReader(); //File API生成
//             reader.onload = (e) => {
//                 this.uploadedImage = e.target.result;
//             };
//
//             reader.readAsDataURL(file);
//         },
//     },
// });

import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import PhraseList from './pages/PhraseList.vue'
import Login from './pages/Login.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
    {
        path: '/',
        component: PhraseList
    },
    {
        path: '/login',
        component: Login
    }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history', // URLがちゃんと表示されるように
    routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router

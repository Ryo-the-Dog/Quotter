import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import PhraseList from './pages/PhraseList.vue'
import Login from './pages/Login.vue'

// ストアをインポート
import store from './store'

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
    },
    {
        path: '/login',
        component: Login,
        // beforeEnter は定義されたルートにアクセスされてページコンポーネントが切り替わる直前に呼び出される関数
        // 第一引数 to はアクセスされようとしているルート
        // 第二引数 from はアクセス元のルート
        // 第三引数 next はページの移動先（切り替わり先）を決める
        beforeEnter (to, from, next) {
            // ログイン状態の場合
            if (store.getters['auth/check']) {
                // 引数ありで next() を呼ぶと切り替わるはずだったページコンポーネントは生成されず、引数のページに切り替わり、リダイレクトのような動きになります。
                next('/')
            } else {
                next()
            }
        }
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

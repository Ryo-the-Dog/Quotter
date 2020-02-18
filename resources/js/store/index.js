import Vue from 'vue'
import Vuex from 'vuex'
// auth.jsをインポート
import auth from './auth'

// Vuex プラグインの使用を宣言することで、this.$store からストアを参照できる。
Vue.use(Vuex)

// ストアを生成する
const store = new Vuex.Store({
    // インポートした auth.js をモジュールとして登録しています。
    modules: {
        auth
    }
})

export default store // app.jsで読み込む

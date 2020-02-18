import Vue from 'vue'
import Vuex from 'vuex'
// auth.jsをインポート
import auth from './auth'

Vue.use(Vuex)

const store = new Vuex.Store({
    // インポートした auth.js をモジュールとして登録しています。
    modules: {
        auth
    }
})

export default store

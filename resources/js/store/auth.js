const state = {
    // ログイン済みユーザーを保持する user
    user: null
}

const getters = {
    check: state => !! state.user, // ログインチェックに使用します。確実に真偽値を返すために二重否定しています。
    username: state => state.user ? state.user.name : '' /*username はログインユーザーの name です。
                        仮に user が null の場合に呼ばれてもエラーが発生しないように空文字を返すようにしています。*/
}

const mutations = {
    // user ステートの値を更新する setUser
    setUser (state, user) { // ミューテーションの第一引数は必ずステートです。
        state.user = user
    }
}

const actions = {
    // 会員登録 API を呼び出す register アクション
    async register (context, data) {
        // 会員登録 API を呼び出し
        const response = await axios.post('/api/register', data)
        // commitメソッドで返却データを渡してsetUser ミューテーションを実行する→ステートが更新される
        context.commit('setUser', response.data)
    },
    async login (context, data) {
        const response = await axios.post('/api/login', data)
        context.commit('setUser', response.data)
    },
    async logout (context) {
        const response = await axios.post('/api/logout')
        context.commit('setUser', null)
    },
    // ログイン認証
    async currentUser (context) {
        const response = await axios.get('/api/user')
        console.log('auth.js/currentUser')
        const user = response.data || null
        context.commit('setUser', user)

    },
}

export default {
    namespaced: true, // 名前の競合を防ぐ
    state,
    getters,
    mutations,
    actions
}

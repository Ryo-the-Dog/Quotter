const state = {
    // ログイン済みユーザーを保持する user
    user: null
}

const getters = {}

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
    }
}

export default {
    namespaced: true, // 名前の競合を防ぐ
    state,
    getters,
    mutations,
    actions
}

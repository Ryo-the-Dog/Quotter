<template>
    <div class="container--small">
        <div class="panel">
            <form class="form">
                <label for="login-email">Email</label>
                <input type="text" class="form__item" id="login-email">
                <label for="login-password">Password</label>
                <input type="password" class="form__item" id="login-password">
                <div class="form__button">
                    <button type="submit" class="button button--inverse">login</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            tab: 1,
            loginForm: {
                email: '',
                password: ''
            },
        }
    },
    methods: {
        login () {
            console.log(this.loginForm)
        }
    },
}
</script>

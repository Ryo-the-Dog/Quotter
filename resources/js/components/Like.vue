<template>
    <span v-if="userId">
        <!-- 未ログインの場合spanタグにする？ -->
        <span v-if="!liked" @click="like(phraseId)"><i class="far fa-heart"></i>{{likeCount}}</span>
        <span v-else @click="unlike(phraseId)"><i class="fas fa-heart"></i>{{likeCount}}</span>
    </span>
    <span v-else>
        <!-- 未ログインの場合spanタグにする？ -->
        <!-- TODO　URLを本番デプロイした時ように/loginと指定したい -->
        <a href="https://laravel.app/login"><i class="fas fa-heart"></i>{{likeCount}}</a>
    </span>
</template>


<script>
    export default {
        // ビューのVueの箇所からフレーズのidとユーザーのidをpropsで受け取る
        props: ['phraseId', 'userId', 'defaultLiked', 'defaultCount'],
        data() {
            return {
                liked: false,
                likeCount: 0,
            };
        },
        created() {
            this.liked = this.defaultLiked
            this.likeCount = this.defaultCount
        },
        methods: {
            like(phraseId) {
                let url = `/api/phrases/${phraseId}/like`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                    this.liked = true
                    this.likeCount = response.data.likeCount
                })
                .catch(error => {
                    alert(error)
                });
            },
            unlike(phraseId) {
                let url = `/api/phrases/${phraseId}/unlike`

                axios.post(url, {
                    user_id: this.userId
                })
                    .then(response => {
                        this.liked = false
                        this.likeCount = response.data.likeCount
                    })
                    .catch(error => {
                        alert(error)
                    });
            }
        }
    }
</script>

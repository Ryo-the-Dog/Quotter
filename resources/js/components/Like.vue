<template>

    <span v-if="userId" class="c-card__btn">
        <!-- 未ログインの場合spanタグにする？ -->
        <span v-if="!liked" @click="like(phraseId)" class="c-btn-like c-btn-like--off like-btn off">
            <i class="far fa-heart c-icon--gray-heart"></i>{{likeCount}}
        </span>
        <span v-else @click="unlike(phraseId)" class="c-btn-like c-btn-like--on like-btn on">
            <i class="fas fa-heart c-icon--pink-heart"></i>{{likeCount}}
        </span>
    </span>

    <span v-else class="c-card__btn">
        <!-- 未ログインの場合spanタグにする？ -->
        <a :href="loginRoute" class="c-btn-like c-btn-like--off">
            <i class="far fa-heart c-icon--gray-heart"></i>{{likeCount}}
        </a>
    </span>

</template>

<script>
    export default {
        // ビューのVueの箇所からフレーズのidとユーザーのidをpropsで受け取る
        props: ['phraseId', 'userId', 'defaultLiked', 'defaultCount', 'loginRoute'],
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

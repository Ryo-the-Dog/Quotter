<template>
    <div >
        <button v-if="!liked" type="button" class="btn btn-primary" @click="like(phraseId)">いいね{{likeCount}}</button>
        <button v-else type="button" class="btn btn-primary" @click="unlike(phraseId)">いいね取消{{likeCount}}</button>
    </div>
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

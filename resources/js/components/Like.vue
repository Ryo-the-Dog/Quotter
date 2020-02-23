<template>
    <div >
        <button v-if="!liked" type="button" class="btn btn-primary" @click="submit(phraseId)">いいね</button>
        <button v-else type="button" class="btn btn-primary" @click="submit(phraseId)">いいね取消</button>
    </div>
</template>

<script>
    export default {
        // ビューのVueの箇所からフレーズのidとユーザーのidをpropsで受け取る
        props: ['phraseId', 'userId', 'defaultLiked'],
        data() {
            return {
                liked: false
            };
        },
        created() {
            this.liked = this.defaultLiked
        },
        methods: {
            submit(phraseId) {
                let url = `/api/phrases/${phraseId}/like`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {

                })
                .catch(error => {
                    alert(error)
                });
            }
        }
    }
</script>

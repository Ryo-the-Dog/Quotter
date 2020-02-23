<template>
    <div >
        <button type="button" class="btn btn-primary" @click="submit(phraseId)">いいね</button>
    </div>
</template>

<script>
    export default {
        // ビューのVueの箇所からフレーズのidとユーザーのidをpropsで受け取る
        props: ['phraseId', 'userId'],
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

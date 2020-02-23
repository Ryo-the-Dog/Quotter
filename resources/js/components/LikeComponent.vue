<!--https://qiita.com/ma7ma7pipipi/items/50a77cd392e9f27915d7-->
<template>

    <div>
        <button v-if="flag" @click="addIine">
            いいね済
        </button>
        <button @click="addIine" v-else>
            いいね
        </button>

    </div>

</template>

<script>
    export default {
        props: ['foreign_key','user_id','model'],

        data () {
            return {
                flag:false,
            };
        },

        created () {
            this.getIine();
        },

        methods: {

            //足跡を追加
            addIine(){
                let dataform = new FormData();
                dataform.append('foreign_key',this.foreign_key);
                dataform.append('user_id',this.user_id);
                dataform.append('model',this.model);
                axios.post('/okws/addIine/', dataform).then(e => {
                    this.flag = e.data.res;
                    console.log("いいね成功");
                }).catch((error) => {
                    console.log("エラー");
                });
            },
            //足跡を追加
            getIine(){
                let dataform = new FormData();
                dataform.append('foreign_key',this.foreign_key);
                dataform.append('user_id',this.user_id);
                dataform.append('model',this.model);
                axios.post('/okws/getIine/', dataform).then(e => {
                    this.flag = e.data.res;
                    console.log("いいねできたか取得");
                }).catch((error) => {
                    console.log("エラー");
                });
            },

        },
    }
</script>

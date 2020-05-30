<template>
    <div>
        <input class="form-control c-input--file" id="title_img_path" type="file" name="title_img_path"
               v-preview-input="uploadedImage" @change="onFileChange">

        <img class="img" id="file-preview" v-show="uploadedImage"
             v-bind:src="uploadedImage" style="width:100%;">

        <span class="text-danger" role="alert">
            <strong>{{ error }}</strong>
        </span>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                uploadedImage: '/img/noimg.png',
                sizeLimit: 1024000,
                error: null,
            };
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files;

                if(files[0].size > this.sizeLimit){
                    this.error = '画像サイズは1MB以下にしてください'
                    return false
                }else{
                    this.error = null
                }

                this.createImage(files[0]); //File情報格納
            },
            //アップロードした画像を表示
            createImage(file) {
                let reader = new FileReader(); //File API生成
                reader.onload = (e) => {
                    this.uploadedImage = e.target.result;
                };

                reader.readAsDataURL(file);
            },
        },
    }
</script>

<style scoped>

</style>

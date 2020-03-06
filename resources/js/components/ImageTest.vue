<template>
<!--  2  -->

        <div class="col-md-6">

            <input class="form-control file-input profile-img-input" id="file-sample" type="file" name="profile_img_path"
                   v-preview-input="uploadedImage"
                   @change="onFileChange">
            <img class="img" id="file-preview"
                 v-show="uploadedImage"
                 v-bind:src="uploadedImage"
                 style="width:100%;">
        </div>


</template>

<script>
    export default {
        props: ['auth'],
        data() {
            return {
                uploadedImage: this.auth.profile_img_path?'/storage/img/'+this.auth.profile_img_path:'/storage/img/noimg.png',
            };
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files;
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

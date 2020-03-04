<template>
<!--  2  -->
<!--    <label for="file-sample">-->
<!--        <div class="drop">-->
<!--            <input class="input" id="file-sample" type="file" name="user_img" @change="onFileChange">-->
<!--            <i aria-hidden="true" class="fas fa-plus fa-7x"></i>-->
<!--            <img class="img" id="file-preview" v-show="uploadedImage" :src="uploadedImage">-->
<!--        </div>-->
<!--    </label>-->
    <input type="file" class="form-control @error('profile_img_path') is-invalid @enderror" id="profile_img_path"
           name="profile_img_path"
           {{--                                           v-on:change="onFileChange"--}}
           {{--                                           v-preview-input="imageData"--}}
           value="@if(!empty(old('profile_img_path') ) ){{old('profile_img_path')}}
                                           @elseif(!empty($auth) ){{ $auth->profile_img_path }}@endif" >
</template>

<script>
    export default {

        // 2
        data() {
            return {
                uploadedImage: "",
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

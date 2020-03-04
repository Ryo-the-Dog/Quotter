import Vue from "vue";

new Vue ({
    el: '#img-prev',
    // data: {
    //     uploadedImage: "",
    // },
    data: {
        imageData: '' //画像格納用変数
    },
    // methods: {
    //     onFileChange(e) {
    //         console.log('file');
    //         let files = e.target.files;
    //
    //         if(files.length > 0) {
    //
    //             let file = files[0];
    //             let reader = new FileReader();
    //
    //             reader.onload = (e) => {
    //                 this.imageData = e.target.result;
    //
    //             };
    //             reader.readAsDataURL(file);
    //         }
    //     }
    // },
    methods: {
            onFileChange(e) {
                let files = e.target.files;
                this.createImage(files[0]); //File情報格納
            },
            //アップロードした画像を表示
            createImage(file) {
                let reader = new FileReader(); //File API生成
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                };

                reader.readAsDataURL(file);
            },
        },
    // data() {
    //     return {
    //         uploadedImage: "",
    //     }
    // },
    // methods: {
    //     onFileChange(e) {
    //         let files = e.target.files;
    //         this.createImage(files[0]); //File情報格納
    //     },
    //     //アップロードした画像を表示
    //     createImage(file) {
    //         let reader = new FileReader(); //File API生成
    //         reader.onload = (e) => {
    //             this.uploadedImage = e.target.result;
    //         };
    //
    //         reader.readAsDataURL(file);
    //     },
    // },
});

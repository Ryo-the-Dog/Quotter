// (function() {
//     'use strict';

    // フラッシュメッセージのfadeout


window.onload = function(){
    setTimeout(function () {
        $('.flash-message').slideUp(1000);
    },2500
    );
    // $('.flash-message').slideUp(3000);
};

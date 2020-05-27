<?php

use JD\Cloudder\Facades\Cloudder;

// Cloudinaryに画像をアップロードする関数
function uploadImg($imgFile) {
    // 画像パスを格納
    $imgName = $imgFile->getRealPath();

    // Cloudinaryへアップロード
    Cloudder::upload($imgName, null);

    list($width, $height) = getimagesize($imgName);

    // 直前にアップロードした画像のユニークIDを取得
    $publicId = Cloudder::getPublicId();

    // URLを生成
    $imgUrl = Cloudder::show($publicId, [
        'width'     => $width,
        'height'    => $height
    ]);

    return $imgUrl;
}

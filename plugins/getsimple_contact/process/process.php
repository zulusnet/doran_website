<?php
if(sc_ajax()) {
    echo sc_get_opencaptcha_image();
}

function sc_ajax(){
    return isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

function sc_get_opencaptcha_image() {
    $date = date("Ymd");
    $rand = md5(uniqid(microtime(), true));
    $height = 100;
    $width  = 300;
    $img    = $date.$rand.'-'.$height.'-'.$width.'.jpgx';
    $return = '<input type="hidden" name="opencaptcha_challenge_field" value="'.$img.'">';
    $return .= '<img src="http://www.opencaptcha.com/img/'.$img.'" alt="OpenCaptcha" />';
    return $return;
}
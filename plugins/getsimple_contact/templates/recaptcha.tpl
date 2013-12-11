<label for="recaptcha_response_field" class="sc-label">[SC_FE_CAPTCHA]</label>
<span id="sc-captcha-error" class="sc-error">[SC_CAPTCHA_ERROR]</span>
<div class="sc-clear"></div>
<div id="recaptcha_widget" class="sc-recaptcha-widget" style="display:none">
    <input type="text" placeholder="[SC_FE_RECAPTCHA_PLACEHOLDER]" id="recaptcha_response_field" name="recaptcha_response_field" class="sc-text" />
    <div class="sc-recaptcha-reload" onclick="javascript:Recaptcha.reload()">[SC_FE_CAPTCHA_RELOAD]</div>
    <div class="recaptcha_only_if_image sc-recaptcha-audio" onclick="javascript:Recaptcha.switch_type('audio');">[SC_FE_CAPTCHA_GET_AUDIO]</div>
    <div class="recaptcha_only_if_audio sc-recaptcha-image" onclick="javascript:Recaptcha.switch_type('image');">[SC_FE_CAPTCHA_GET_IMAGE]</div>
    <div class="sc-clear"></div>
    <div id="recaptcha_image" class="sc-recaptcha-img"></div>
    <div class="sc-clear"></div>
</div>
<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=[SC_FE_CAPTCHA_PUBLIC]"></script>
[SC_FE_RECAPTCHA_RESET_IMG_WIDTH]
<noscript>
    <iframe src="http://www.google.com/recaptcha/api/noscript?k=[SC_FE_CAPTCHA_PUBLIC]" frameborder="0" class="sc-recaptcha-frame"></iframe>
    <textarea name="recaptcha_challenge_field" class="sc-recaptcha-text-area"></textarea>
    <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
</noscript>
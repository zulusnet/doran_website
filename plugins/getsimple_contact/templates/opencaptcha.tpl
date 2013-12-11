<div class="form-group">
<label for="recaptcha_response_field" class="col-sm-2 control-label">[SC_FE_CAPTCHA]</label>
<div class="col-sm-5">
  <div id="opencaptcha_image" class="opencaptcha-img">[SC_FE_OPENCAPTCHA_IMAGE]</div>
</div>
<div class="col-sm-5">
<div class="input-group">
<input type="text" placeholder="[SC_FE_OPENCAPTCHA_PLACEHOLDER]" id="opencaptcha_response_field" name="opencaptcha_response_field" class="form-control" />
<span class="input-group-btn">
<button class="btn btn-default" onclick="ReloadCaptcha()" type="button">[SC_FE_CAPTCHA_RELOAD]</button>
</span>
</div>
<span id="sc-captcha-error" class="sc-error">[SC_CAPTCHA_ERROR]</span>
</div>
</div>
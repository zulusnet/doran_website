[SC_FE_SCRIPTS]
<div class="sc-success">[SC_FE_SUCCESS]</div>
<div class="sc-error">[SC_FE_PHP_MAILER]</div>
<div class="sc-error">[SC_FE_INVALID_FORM]</div>

<form class="form-horizontal" role="form" method="post" [SC_FE_ENCTYPE]>
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">[SC_FE_NAME]</label>
    <div class="col-sm-10">
	  <input type="text" placeholder="[SC_FE_NAME_PLACEHOLDER]" name="name" id="name" class="form-control" />
	  <span class="sc-error">[SC_FE_ERROR_NAME]</span>
    </div>
  </div>
  <div class="form-group">
    <label for="subject" class="col-sm-2 control-label">[SC_FE_SUBJECT]</label>
    <div class="col-sm-10">
	  <input type="text" placeholder="[SC_FE_SUBJECT_PLACEHOLDER]" name="subject" id="subject" class="form-control" />
	  <span class="sc-error">[SC_FE_ERROR_SUBJECT]</span>
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">[SC_FE_EMAIL]</label>
    <div class="col-sm-10">
	  <input type="text" placeholder="[SC_FE_EMAIL_PLACEHOLDER]" name="email" id="email" class="form-control" />
	  <span class="sc-error">[SC_FE_ERROR_EMAIL]</span>
    </div>
  </div>
  [SC_FE_WYSIHTML5_EDITOR]
  <div class="form-group">
    <label for="message" class="col-sm-2 control-label">[SC_FE_MESSAGE]</label>
    <div class="col-sm-10">
	  <textarea name="message" id="message" class="form-control" rows="5" placeholder="[SC_FE_MESSAGE_PLACEHOLDER]"></textarea>
	  <span class="sc-error">[SC_FE_ERROR_MESSAGE]</span>
    </div>
  </div>
  [SC_FE_ATTACHMENT_FORM]
  [SC_FE_FINAL_CAPTCHA]
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
	  <input type="hidden" id="token" name="token" value="[SC_FE_TOKEN]">
      <button type="submit" name="submit" class="btn btn-primary">[SC_FE_SUBMIT]</button>
    </div>
  </div>
</form>
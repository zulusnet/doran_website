[SC_FE_SCRIPTS]
<div class="row">
	<div class="col-md-12">
		<div class="sc-success">[SC_FE_SUCCESS]</div>
		<div class="sc-error">[SC_FE_PHP_MAILER]</div>
		<div class="sc-error">[SC_FE_INVALID_FORM]</div>
	</div>
</div>

<form role="form" method="post" [SC_FE_ENCTYPE]>

<div class="row">
	<div class="col-md-4">
	  <div class="form-group">
		<label for="name" class="control-label">[SC_FE_NAME]</label>
		  <input type="text" placeholder="[SC_FE_NAME_PLACEHOLDER]" name="name" id="name" class="form-control" />
		  <span class="label label-danger">[SC_FE_ERROR_NAME]</span>
	  </div>
	  <div class="form-group">
		<label for="subject" class="control-label">[SC_FE_SUBJECT]</label>
		  <input type="text" placeholder="[SC_FE_SUBJECT_PLACEHOLDER]" name="subject" id="subject" class="form-control" />
		  <span class="label label-danger">[SC_FE_ERROR_SUBJECT]</span>
	  </div>
	  <div class="form-group">
		<label for="email" class="control-label">[SC_FE_EMAIL]</label>
		  <input type="text" placeholder="[SC_FE_EMAIL_PLACEHOLDER]" name="email" id="email" class="form-control" />
		  <span class="label label-danger">[SC_FE_ERROR_EMAIL]</span>
	  </div>
	</div>

	<div class="col-md-8">
	  [SC_FE_WYSIHTML5_EDITOR]
	  <div class="form-group">
		<label for="message" class="control-label">[SC_FE_MESSAGE]</label>
		  <textarea name="message" id="message" class="textarea-message form-control" rows="5" placeholder="[SC_FE_MESSAGE_PLACEHOLDER]"></textarea>
		  <span class="label label-danger">[SC_FE_ERROR_MESSAGE]</span>
	  </div>
	</div>
</div>

[SC_FE_ATTACHMENT_FORM]
[SC_FE_FINAL_CAPTCHA]

<div class="row">
	<div class="col-md-12 text-center">
		<hr/>
		<div class="form-group">
		  <input type="hidden" id="token" name="token" value="[SC_FE_TOKEN]">
		  <button type="submit" name="submit" class="btn btn-primary btn-lg">[SC_FE_SUBMIT]</button>
		</div>
	</div>
</div>

</form>

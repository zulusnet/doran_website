<form id="sc-contact" method="post">
    <p>
        <label for="superadmin_name" class="sc-label">[SC_BE_SUPERADMIN_NAME]</label>
        <input type="text" name="superadmin_name" id="superadmin_name" class="text" value="[SC_BE_SUPERADMIN_NAME_SETTINGS]" />
    </p>
    <p>
        <label for="superadmin_email" class="sc-label">[SC_BE_SUPERADMIN_EMAIL]</label>
        <input type="text" name="superadmin_email" id="superadmin_email" class="text" value="[SC_BE_SUPERADMIN_EMAIL_SETTINGS]" />
    </p>
    <p>[SC_BE_SUPERADMIN_DESC]</p>
    <p>
        <label for="recipient_name" class="sc-label">[SC_BE_RECIPIENT_NAME]</label>
        <input type="text" name="recipient_name" id="recipient_name" class="text" value="[SC_BE_RECIPIENT_NAME_SETTINGS]" />
    </p>
    <p>
        <label for="recipient_email" class="sc-label">[SC_BE_RECIPIENT_EMAIL]</label>
        <input type="text" name="recipient_email" id="recipient_email" class="text" value="[SC_BE_RECIPIENT_EMAIL_SETTINGS]" />
    </p>
    <p>
        <label for="smtp_status" class="sc-label">[SC_BE_SMTP_STATUS]</label>
        <select id="smtp_status" name="smtp_status" class="text">
            <option value="0"[SC_BE_SMTP_SELECTED_OFF]>[SC_BE_SMTP_OFF]</option>
            <option value="1"[SC_BE_SMTP_SELECTED_ON]>[SC_BE_SMTP_ON]</option>
        </select>
    </p>
    <div id="show_smtp_settings">
        <p>
            <label for="smtp_host" class="sc-label">[SC_BE_SMTP_HOST]</label>
            <input type="text" name="smtp_host" id="smtp_host" class="text" value="[SC_BE_SMTP_HOST_SETTINGS]" />
        </p>
        <p>
            <label for="smtp_port" class="sc-label">[SC_BE_SMTP_PORT]</label>
            <input type="text" name="smtp_port" id="smtp_port" class="text" value="[SC_BE_SMTP_PORT_SETTINGS]" />
        </p>
        <p>
            <label for="smtp_auth" class="sc-label">[SC_BE_SMTP_AUTH]</label>
            <select id="smtp_auth" name="smtp_auth" class="text">
                <option value="0"[SC_BE_SMTP_AUTH_SELECTED_OFF]>[SC_BE_SMTP_AUTH_OFF]</option>
                <option value="1"[SC_BE_SMTP_AUTH_SELECTED_ON]>[SC_BE_SMTP_AUTH_ON]</option>
            </select>
        </p>
        <div id="show_smtp_settings_sub">
            <p>
                <label for="smtp_username" class="sc-label">[SC_BE_SMTP_USERNAME]</label>
                <input type="text" name="smtp_username" id="smtp_username" class="text" value="[SC_BE_SMTP_USERNAME_SETTINGS]" />
            </p>
            <p>
                <label for="smtp_password" class="sc-label">[SC_BE_SMTP_PASSWORD]</label>
                <input type="password" name="smtp_password" id="smtp_password" class="text" />
            </p>
        </div>
    </div>
    <p>
        <label for="cc_status" class="sc-label">[SC_BE_CC_STATUS]</label>
        <select id="cc_status" name="cc_status" class="text">
            <option value="0"[SC_BE_CC_SELECTED_OFF]>[SC_BE_CC_OFF]</option>
            <option value="1"[SC_BE_CC_SELECTED_ON]>[SC_BE_CC_ON]</option>
        </select>
    </p>
     <p>
        <label for="attachments_status" class="sc-label">[SC_BE_ATTACHMENTS_STATUS]</label>
        <select id="attachments_status" name="attachments_status" class="text">
            <option value="0"[SC_BE_ATTACHMENTS_SELECTED_OFF]>[SC_BE_ATTACHMENTS_OFF]</option>
            <option value="1"[SC_BE_ATTACHMENTS_SELECTED_ON]>[SC_BE_ATTACHMENTS_ON]</option>
        </select>
    </p>
    <p>
        <label for="wysihtml5_editor" class="sc-label">[SC_BE_WYSIHTML5_EDITOR]</label>
        <select id="wysihtml5_editor" name="wysihtml5_editor" class="text">
            <option value="0"[SC_BE_WYSIHTML5_EDITOR_SELECTED_OFF]>[SC_BE_WYSIHTML5_EDITOR_OFF]</option>
            <option value="1"[SC_BE_WYSIHTML5_EDITOR_SELECTED_ON]>[SC_BE_WYSIHTML5_EDITOR_ON]</option>
        </select>
    </p>
    <p>
        <label for="captcha_type" class="sc-label">[SC_BE_CAPTCHA_TYPE]</label>
        <select id="captcha_type" name="captcha_type" class="text">
            <option value="0"[SC_BE_CAPTCHA_SELECT_OPENCAPTCHA_SELECTED]>[SC_BE_CAPTCHA_SELECT_OPENCAPTCHA]</option>
            <option value="1"[SC_BE_CAPTCHA_SELECT_RECAPTCHA_SELECTED]>[SC_BE_CAPTCHA_SELECT_RECAPTCHA]</option>
            <option value="2"[SC_BE_CAPTCHA_SELECT_NOCAPTCHA_SELECTED]>[SC_BE_CAPTCHA_SELECT_NOCAPTCHA]</option>
        </select>
    </p>
    <div id="show_opencaptcha">
        <p>[SC_BE_OPENCAPTCHA_DESC]</p>
        <p>[SC_BE_OPENCAPTCHA_LINK]</p>
    </div>
    <div id="show_recaptcha">
        <p>
            <label for="recaptcha_status" class="sc-label">[SC_BE_RECAPTCHA_STATUS]</label>
            <select id="recaptcha_status" name="recaptcha_status" class="text">
                <option value="0"[SC_BE_RECAPTCHA_SELECT_DISABLED_SELECTED]>[SC_BE_RECAPTCHA_SELECT_DISABLED]</option>
                <option value="1"[SC_BE_RECAPTCHA_SELECT_ENABLED_SELECTED]>[SC_BE_RECAPTCHA_SELECT_ENABLED]</option>
            </select>
        </p>
        <p>
            <label for="recaptcha_public_key" class="sc-label">[SC_BE_RECAPTCHA_PUBLIC_KEY]</label>
            <input type="text" name="recaptcha_public_key" id="recaptcha_public_key" class="text" value="[SC_BE_RECAPTCHA_PUBLIC_KEY_SETTINGS]" />
        </p>
        <p>
            <label for="recaptcha_private_key" class="sc-label">[SC_BE_RECAPTCHA_PRIVATE_KEY]</label>
            <input type="text" name="recaptcha_private_key" id="recaptcha_private_key" class="text" value="[SC_BE_RECAPTCHA_PRIVATE_KEY_SETTINGS]" />
        </p>
        <p>[SC_BE_RECAPTCHA_DESC]</p>
        <p>[SC_BE_RECAPTCHA_LINK]</p>
    </div>
    <div id="submit_line">
        <span><input type="submit" name="submit" value="[SC_FE_BE_SUBMIT]" class="submit" /></span>
    </div>
</form>

<p>[SC_BE_ICONS_LINK]</p>
[SC_BE_SCRIPTS]
<script type="text/javascript">
jQuery(document).ready(function() {
    if($('#captcha_type').val()==='0') {
        $('#show_recaptcha').hide();
        var hidden = 1;
    } else if($('#captcha_type').val()==='1') {
        $('#show_opencaptcha').hide();
        var hidden = 2;
    } else if($('#captcha_type').val()==='2') {
        $('#show_recaptcha').hide();
        $('#show_opencaptcha').hide();
        var hidden = 0;
    }
    if($('#smtp_status').val()==='0') {
        $('#show_smtp_settings').hide();
        var smtp_hidden = 1;
    } else {
        var smtp_hidden = 0;
    }
    if($('#smtp_auth').val()==='0') {
        $('#show_smtp_settings_sub').hide();
        var smtp_sub_hidden = 1;
    } else {
        var smtp_sub_hidden = 0;
    }
    $('#captcha_type').on('change keyup', function() {
        if($('#captcha_type').val()==='0') {
            if (this.value == $(this).data('curr_val'))
                return false;
            if (hidden == 1 || hidden == 2) {
                $('#show_recaptcha').slideToggle('slow');
                $('#show_opencaptcha').slideToggle('slow');
            } else if (hidden == 0) {
                $('#show_opencaptcha').slideToggle('slow');
            }
            hidden = 1;
            $(this).data('curr_val', this.value);
        } else if($('#captcha_type').val()==='1') {
            if (this.value == $(this).data('curr_val'))
                return false;
            if (hidden == 1 || hidden == 2) {
                $('#show_opencaptcha').slideToggle('slow');
                $('#show_recaptcha').slideToggle('slow');
            } else if (hidden == 0) {
                $('#show_recaptcha').slideToggle('slow');
            }
            hidden = 2;
            $(this).data('curr_val', this.value);
        } else if($('#captcha_type').val()==='2') {
            if (this.value == $(this).data('curr_val'))
                return false;
            $('#show_recaptcha').hide();
            $('#show_opencaptcha').hide();
            hidden = 0;
            $(this).data('curr_val', this.value);
        }
    });
    $('#smtp_status').on('change keyup', function() {
        if($('#smtp_status').val()==='0') {
            if (this.value == $(this).data('curr_val'))
                return false;
            if (smtp_hidden == 0) {
                $('#show_smtp_settings').slideToggle('slow');
            }
            smtp_hidden = 1;
            $(this).data('curr_val', this.value);
        } else if($('#smtp_status').val()==='1') {
            if (this.value == $(this).data('curr_val'))
                return false;
            if (smtp_hidden == 1) {
                $('#show_smtp_settings').slideToggle('slow');
            }
            smtp_hidden = 0;
            $(this).data('curr_val', this.value);
        }
    });
    $('#smtp_auth').on('change keyup', function() {
        if($('#smtp_auth').val()==='0') {
            if (this.value == $(this).data('curr_val'))
                return false;
            if (smtp_sub_hidden == 0) {
                $('#show_smtp_settings_sub').slideToggle('slow');
            }
            smtp_sub_hidden = 1;
            $(this).data('curr_val', this.value);
        } else if($('#smtp_auth').val()==='1') {
            if (this.value == $(this).data('curr_val'))
                return false;
            if (smtp_sub_hidden == 1) {
                $('#show_smtp_settings_sub').slideToggle('slow');
            }
            smtp_sub_hidden = 0;
            $(this).data('curr_val', this.value);
        }
    });
});
</script>
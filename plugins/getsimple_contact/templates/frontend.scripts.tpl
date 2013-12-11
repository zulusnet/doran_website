[SC_FE_CSS]
[SC_FE_JQUERY]
[SC_FE_VALIDATE]
[SC_FE_WYSIHTML5_SCRIPTS]
<script type="text/javascript">
jQuery(document).ready(function() {
    $('#sc-contact').validate({
        ignore: "",
        errorPlacement: function(error, element) {
            if (error[0].htmlFor=="recaptcha_response_field" || error[0].htmlFor=="opencaptcha_response_field") {
                $("#sc-captcha-error").html("");
                error.appendTo("#sc-captcha-error");
            } else {
                element.prev("span").html("");
                error.appendTo( element.prev("span") );
            }
        }, 
        rules: {
            name: {
                required: true
            },
            subject: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            message: {
                required: true,
                minlength: 1
            },
            [SC_FE_CAPTCHA_RULE]
        },
        messages: {
            name: "[SC_FE_NAME_REQUIRED]",
            subject: "[SC_FE_SUBJECT_REQUIRED]",
            email: {
                required: "[SC_FE_EMAIL_REQUIRED]",
                email: "[SC_FE_EMAIL_INVALID]"
            },
            message: "[SC_FE_MESSAGE_REQUIRED]",
            [SC_FE_CAPTCHA_MESSAGE]
        }
    });
    [SC_FE_WYSIHTML5_EDITOR]
});
[SC_FE_CAPTCHA_WIDGET]
</script>
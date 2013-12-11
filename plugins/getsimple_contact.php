<?php

/*
  Plugin Name: GetSimple Contact
  Description: Simple contact form plugin for GetSimple
  Version: 1.3.0
  Author: Kolyok
  Author URI: http://get-simple.info/forums/member.php?action=profile&uid=7989
 */

$thisfile_sc = basename(__FILE__, ".php");

i18n_merge($thisfile_sc) || i18n_merge($thisfile_sc, 'en_US');

$sc_language = sc_language();

register_plugin(
        $thisfile_sc,
        sc_i18n($thisfile_sc, $sc_language, 'SC_TITLE'),
        '1.3.0',
        'Kolyok',
        'http://get-simple.info/forums/member.php?action=profile&uid=7989',
        sc_i18n($thisfile_sc, $sc_language, 'SC_DESC'),
        'plugins',
        'sc_backend'
);

add_action('plugins-sidebar', 'createSideMenu', array($thisfile_sc, sc_i18n($thisfile_sc, $sc_language, 'SC_TITLE_ADMIN')));
add_action('index-pretemplate', 'sc_generate_token');
add_filter('content', 'sc_frontend');

define('SC_SMTPSALT','AfwoZCSlrcdyN_RzzC');
define('SC_SMTPPEPPER','Zh%7Qyar-WZH-i8%%w');

$settings_file = GSDATAOTHERPATH . 'getsimple_contact_settings.xml';
$settings_update = array('CAPTCHA_TYPE' => array('captcha_type' => 0), 'RECAPTCHA_STATUS' => array('recaptcha_status' => 0),
    'SUPERADMIN_NAME' => array('superadmin_name' => 'Superadmin Name'), 'SUPERADMIN_EMAIL' => array('superadmin_email' => 'superadmin@name.com'),
    'WYSIHTML5_EDITOR' => array('wysihtml5_editor' => 1), 'CC_STATUS' => array('cc_status' => 0), 'ATTACHMENTS_STATUS' => array('attachments_status' => 0),
    'SMTP_STATUS' => array('smtp_status' => 0),'SMTP_HOST' => array('smtp_host' => 'localhost'),'SMTP_PORT' => array('smtp_port' => 25),
    'SMTP_AUTH' => array('smtp_auth' => 0),'SMTP_USERNAME' => array('smtp_username' => ''),'SMTP_PASSWORD' => array('smtp_password' => ''));

sc_be_update_settings($settings_update);

function sc_backend() {
    if (isset($_POST) && $_POST) {
        sc_save_settings($_POST);
        echo sc_be_content();
    } else {
        echo sc_be_content();
    }
}

function sc_frontend($content) {
    if (preg_match('#\[sc_form(.*)\]#', $content)) {
        if (isset($_POST) && $_POST) {
            if (isset($_FILES) && $_FILES) {
                $data = array_merge($_POST,$_FILES);
            } else {
                $data = $_POST;
            }
            return sc_mail($content, $data);
        } else {
            return sc_content($content);
        }
    } else {
        return $content;
    }
}

function sc_content($content, $error = null) {
    $form = sc_render_form($error);
    $content = preg_replace('#\[sc_form(.*)\]#', $form, $content);
    return $content;
}

function sc_render_form($error = null) {
    global $thisfile_sc, $sc_language,$SITEURL;
    require_once GSPLUGINPATH . 'getsimple_contact/inc/class.template.php';
    $frontend = new SCTemplate(GSPLUGINPATH . 'getsimple_contact/templates/frontend.form.tpl');
    $settings = sc_get_settings();
    $token = sc_get_token();
    if (count($error) > 0) {
        $err = array();
        $err['name'] = isset($error['name']) ? $error['name'] : '';
        $err['subject'] = isset($error['subject']) ? $error['subject'] : '';
        $err['email'] = isset($error['email']) ? $error['email'] : '';
        $err['message'] = isset($error['message']) ? $error['message'] : '';
        $err['attachment'] = isset($error['attachment']) ? $error['attachment'] : '';
        $err['captcha'] = isset($error['captcha']) ? $error['captcha'] : '';
        $err['success'] = isset($error['success_message']) ? $error['success_message'] : '';
        $err['php_mailer'] = isset($error['php_mailer']) ? $error['php_mailer'] : '';
        $err['invalid_form'] = isset($error['invalid_form']) ? $error['invalid_form'] : '';
    } else {
        $err = array('name' => '', 'subject' => '', 'email' => '', 'message' => '','attachment'=>'', 'captcha' => '', 'success' => '', 'php_mailer' => '', 'invalid_form' => '');
    }
    if ($settings['captcha_type'] == 1) {
        if ($settings['recaptcha_status'] == 1) {
            $reset_recaptcha_img_width = '<script type="text/javascript">jQuery(document).ready(function() { jQuery("#recaptcha_image img").removeAttr("style width height"); jQuery("#recaptcha_image").removeAttr("style"); });</script>';
            $recaptcha = new SCTemplate(GSPLUGINPATH . 'getsimple_contact/templates/recaptcha.tpl');
            $recaptcha->set('FE_CAPTCHA', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_CAPTCHA'));
            $recaptcha->set('CAPTCHA_ERROR', $err['captcha']);
            $recaptcha->set('FE_RECAPTCHA_PLACEHOLDER', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_RECAPTCHA_PLACEHOLDER'));
            $recaptcha->set('FE_CAPTCHA_RELOAD', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_CAPTCHA_RELOAD'));
            $recaptcha->set('FE_CAPTCHA_GET_AUDIO', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_CAPTCHA_GET_AUDIO'));
            $recaptcha->set('FE_CAPTCHA_GET_IMAGE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_CAPTCHA_GET_IMAGE'));
            $recaptcha->set('FE_CAPTCHA_PUBLIC', $settings['recaptcha_public_key']);
            $recaptcha->set('FE_RECAPTCHA_RESET_IMG_WIDTH', $reset_recaptcha_img_width);
            $captcha_form = $recaptcha->output();
        } else {
            $captcha_form = '';
        }
    } else if ($settings['captcha_type'] == 0) {
        require_once GSPLUGINPATH . 'getsimple_contact/process/process.php';
        $opencaptcha = new SCTemplate(GSPLUGINPATH . 'getsimple_contact/templates/opencaptcha.tpl');
        $opencaptcha->set('FE_CAPTCHA', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_CAPTCHA'));
        $opencaptcha->set('CAPTCHA_ERROR', $err['captcha']);
        $opencaptcha->set('FE_OPENCAPTCHA_PLACEHOLDER', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_OPENCAPTCHA_PLACEHOLDER'));
        $opencaptcha->set('FE_CAPTCHA_RELOAD', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_CAPTCHA_RELOAD'));
        $opencaptcha->set('FE_OPENCAPTCHA_IMAGE', sc_get_opencaptcha_image());
        $captcha_form = $opencaptcha->output();
    } else {
        $captcha_form = '';
    }
    if ($settings['wysihtml5_editor'] == 1) {
        $wysihtml5 = new SCTemplate(GSPLUGINPATH . 'getsimple_contact/templates/wysihtml5.tpl');
        $wysihtml5->set('FE_EDITOR_BOLD_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_BOLD_TITLE'));
        $wysihtml5->set('FE_EDITOR_ITALIC_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_ITALIC_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_LINK_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_LINK_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_IMAGE_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_IMAGE_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_SMILEY_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_SMILEY_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_SMILEY_LABEL', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_SMILEY_LABEL'));
        $wysihtml5->set('FE_EDITOR_INSERT_H1_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_H1_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_H2_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_H2_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_UL_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_UL_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_OL_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_OL_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_RED_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_RED_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_GREEN_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_GREEN_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_BLUE_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_BLUE_TITLE'));
        $wysihtml5->set('FE_EDITOR_UNDO_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_UNDO_TITLE'));
        $wysihtml5->set('FE_EDITOR_REDO_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_REDO_TITLE'));
        $wysihtml5->set('FE_EDITOR_SWITCH_TO_SOURCE_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_SWITCH_TO_SOURCE_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_LINK_LABEL', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_LINK_LABEL'));
        $wysihtml5->set('FE_EDITOR_INSERT_LINK_OK_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_LINK_OK_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_LINK_CANCEL_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_LINK_CANCEL_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_IMAGE_LABEL', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_IMAGE_LABEL'));
        $wysihtml5->set('FE_EDITOR_INSERT_IMAGE_OK_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_IMAGE_OK_TITLE'));
        $wysihtml5->set('FE_EDITOR_INSERT_IMAGE_CANCEL_TITLE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_INSERT_IMAGE_CANCEL_TITLE'));
        $wysihtml5->set('FE_EDITOR_IMAGE_ALIGN_SELECT_DEFAULT', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_IMAGE_ALIGN_SELECT_DEFAULT'));
        $wysihtml5->set('FE_EDITOR_IMAGE_ALIGN_SELECT_LEFT', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_IMAGE_ALIGN_SELECT_LEFT'));
        $wysihtml5->set('FE_EDITOR_IMAGE_ALIGN_SELECT_RIGHT', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EDITOR_IMAGE_ALIGN_SELECT_RIGHT'));
        $wysihtml5->set('FE_SMILEY_URL', $SITEURL.'/plugins/getsimple_contact/images/smileys/');
        $wysihtml5_editor = $wysihtml5->output();
    } else {
        $wysihtml5_editor = '';
    }
    if ($settings['attachments_status'] == 1) {
        $attachment = new SCTemplate(GSPLUGINPATH . 'getsimple_contact/templates/attachment.tpl');
        $attachment->set('FE_ATTACHMENT', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT'));
        $attachment->set('FE_ERROR_ATTACHMENT', $err['attachment']);
        $attachment_form = $attachment->output();
        $enctype = 'enctype="multipart/form-data"';
    } else {
        $attachment_form = '';
        $enctype = '';
    }
    $frontend->set('FE_SCRIPTS', sc_scripts());
    $frontend->set('FE_SUCCESS', $err['success']);
    $frontend->set('FE_PHP_MAILER', $err['php_mailer']);
    $frontend->set('FE_INVALID_FORM', $err['invalid_form']);
    $frontend->set('FE_ENCTYPE', $enctype);
    $frontend->set('FE_NAME', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_NAME'));
    $frontend->set('FE_ERROR_NAME', $err['name']);
    $frontend->set('FE_NAME_PLACEHOLDER', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_NAME_PLACEHOLDER'));
    $frontend->set('FE_SUBJECT', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_SUBJECT'));
    $frontend->set('FE_ERROR_SUBJECT', $err['subject']);
    $frontend->set('FE_SUBJECT_PLACEHOLDER', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_SUBJECT_PLACEHOLDER'));
    $frontend->set('FE_EMAIL', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EMAIL'));
    $frontend->set('FE_ERROR_EMAIL', $err['email']);
    $frontend->set('FE_EMAIL_PLACEHOLDER', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EMAIL_PLACEHOLDER'));
    $frontend->set('FE_WYSIHTML5_EDITOR', $wysihtml5_editor);
    $frontend->set('FE_MESSAGE', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_MESSAGE'));
    $frontend->set('FE_ERROR_MESSAGE', $err['message']);
    $frontend->set('FE_MESSAGE_PLACEHOLDER', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_MESSAGE_PLACEHOLDER'));
    $frontend->set('FE_ATTACHMENT_FORM', $attachment_form);
    $frontend->set('FE_FINAL_CAPTCHA', $captcha_form);
    $frontend->set('FE_TOKEN', $token);
    $frontend->set('FE_SUBMIT', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_SUBMIT'));
    return $frontend->output();
}

function sc_scripts() {
    global $SITEURL, $thisfile_sc, $sc_language;
    require_once GSPLUGINPATH . 'getsimple_contact/inc/class.template.php';
    $frontend = new SCTemplate(GSPLUGINPATH . 'getsimple_contact/templates/frontend.scripts.tpl');
    $settings = sc_get_settings();
    if ($settings['captcha_type'] == 1) {
        if ($settings['recaptcha_status'] == 1) {
            $captcha = 'recaptcha_response_field: {
                            required: true
                        }';
            $captcha_msg = 'recaptcha_response_field: "' . sc_i18n($thisfile_sc, $sc_language, 'SC_FE_CAPTCHA_REQUIRED') . '"';
            $captcha_widget = 'var RecaptchaOptions = {
                                    theme : "custom",
                                    custom_theme_widget: "recaptcha_widget"
                                };';
        } else {
            $captcha = '';
            $captcha_msg = '';
            $captcha_widget = '';
        }
    } else if ($settings['captcha_type'] == 0) {
        $captcha = 'opencaptcha_response_field: {
                        required: true
                    }';
        $captcha_msg = 'opencaptcha_response_field: "' . sc_i18n($thisfile_sc, $sc_language, 'SC_FE_CAPTCHA_REQUIRED') . '"';
        $captcha_widget = 'function ReloadCaptcha() {
                                $.get(\'' . $SITEURL . 'plugins/getsimple_contact/process/process.php\', function(data) {
                                    $(\'#opencaptcha_image\').html(data);
                                });
                            }';
    } else {
        $captcha = '';
        $captcha_msg = '';
        $captcha_widget = '';
    }
    if ($settings['wysihtml5_editor'] == 1) {
        $wysihtml5_settings = 'wysihtml5_sc_Editor = new wysihtml5.Editor("message", {
                                    toolbar: "toolbar",
                                    stylesheets: "' . $SITEURL . 'plugins/getsimple_contact/css/stylesheet.css",
                                    parserRules: wysihtml5ParserRules
                                  });';
        $wysihtml5_scripts = '<script type="text/javascript" src="' . $SITEURL . 'plugins/getsimple_contact/js/advanced.js"></script>
            <script type="text/javascript" src="' . $SITEURL . 'plugins/getsimple_contact/js/wysihtml5-0.4.0pre.min.js"></script>';
    } else {
        $wysihtml5_settings = '';
        $wysihtml5_scripts = '';
    }
    $frontend->set('FE_CSS', '<link rel="stylesheet" type="text/css" href="' . $SITEURL . 'plugins/getsimple_contact/css/simple_contact.css"></link>');
    $frontend->set('FE_JQUERY', '<script>window.jQuery || document.write(\'<script src="' . $SITEURL . 'plugins/getsimple_contact/js/jquery-1.10.2.min.js"><\/script>\')</script>');
    $frontend->set('FE_VALIDATE', '<script type="text/javascript" src="' . $SITEURL . 'plugins/getsimple_contact/js/jquery.validate.min.js"></script>');
    $frontend->set('FE_WYSIHTML5_SCRIPTS', $wysihtml5_scripts);
    $frontend->set('FE_CAPTCHA_RULE', $captcha);
    $frontend->set('FE_CAPTCHA_MESSAGE', $captcha_msg);
    $frontend->set('FE_CAPTCHA_WIDGET', $captcha_widget);
    $frontend->set('FE_WYSIHTML5_EDITOR', $wysihtml5_settings);
    $frontend->set('FE_NAME_REQUIRED', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_NAME_REQUIRED'));
    $frontend->set('FE_SUBJECT_REQUIRED', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_SUBJECT_REQUIRED'));
    $frontend->set('FE_EMAIL_REQUIRED', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EMAIL_REQUIRED'));
    $frontend->set('FE_EMAIL_INVALID', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EMAIL_INVALID'));
    $frontend->set('FE_MESSAGE_REQUIRED', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_MESSAGE_REQUIRED'));
    return $frontend->output();
}

function sc_mail($content, $data) {
    global $thisfile_sc, $sc_language;
    $data = sc_check_post($data);
    if ($data['valid'] == true) {
        $settings = sc_get_settings();
        require_once GSPLUGINPATH . 'getsimple_contact/inc/class.phpmailer.php';
        require_once GSPLUGINPATH . 'getsimple_contact/inc/class.html2text.php';
        $nonHTML = new html2text($data['message']);
        $mail = new PHPMailer;
        $recipients = sc_get_recipients();
        if ($settings['smtp_status'] == 1) {
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->Host       = $settings['smtp_host'];
            $mail->Port       = $settings['smtp_port'];
            if ($settings['smtp_auth'] == 1) {
                $mail->SMTPAuth   = true;
                $mail->Username   = $settings['smtp_username'];
                $mail->Password   = sc_decrypt_smtp_password($settings['smtp_password']);
                if ($settings['smtp_host']=='smtp.gmail.com' && $settings['smtp_port']==465) {
                    $mail->SMTPSecure = 'ssl';
                } else if ($settings['smtp_host']=='smtp.gmail.com' && $settings['smtp_port']==587) {
                    $mail->SMTPSecure = 'tls';
                }
            }
            
        } else {
            $mail->setLanguage('en_US', GSPLUGINPATH . 'getsimple_contact/lang/');
        }
        $mail->CharSet = 'UTF-8';
        $mail->From = $data['email'];
        $mail->FromName = $data['name'];
        foreach ($recipients as $recipient) {
            foreach ($recipient as $key => $value) {
                $mail->addAddress($key, $value);
            }
        }
        if ($settings['cc_status'] == 1) {
            $mail->addCC($data['email'], $data['name']);
        }
        $mail->addReplyTo($data['email'], $data['name']);
        $mail->WordWrap = 50;
        $mail->isHTML(true);

        $mail->Subject = $data['subject'];
        $mail->Body = $data['message'];
        $mail->AltBody = $nonHTML->get_text();
        
        if ($settings['attachments_status'] == 1) {
            $info = pathinfo($data['attachment']['name']);
            $extension = isset($info['extension']) ? $info['extension'] : '';
            $mail->addAttachment($data['attachment']['tmp_name'], sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_NAME').'.'.$extension);
        }
        if (!$mail->send()) {
            if ($settings['smtp_status'] == 1) {
                $content = sc_content($content, array('php_mailer' => $mail->ErrorInfo));
                return $content;
            } else {
                $content = sc_content($content, array('php_mailer' => sc_i18n($thisfile_sc, $sc_language, $mail->ErrorInfo)));
                return $content;
            }
        } else {
            $content = sc_content($content, array('success_message' => sc_i18n($thisfile_sc, $sc_language, 'SC_FE_MESSAGE_SENT'), 'success' => true));
            return $content;
        }
    } else {
        $content = sc_content($content, $data['error']);
        return $content;
    }
}

function sc_check_post($data) {
    global $thisfile_sc, $sc_language;
    $check = sc_is_whitelisted($data);
    if ($check) {
        $settings = sc_get_settings();
        $error = array();
        if (isset($data['name'])) {
            $data['name'] = strip_tags($data['name']);
            $data['name'] = trim($data['name']);
            $data['name'] = stripslashes($data['name']);
            $data['name'] = htmlspecialchars($data['name']);
            if (empty($data['name']) || is_null($data['name']) || $data['name'] == '') {
                $error['name'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_NAME_REQUIRED');
            }
        } else {
            $error['name'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_NAME_REQUIRED');
        }
        if (isset($data['subject'])) {
            $data['subject'] = strip_tags($data['subject']);
            $data['subject'] = trim($data['subject']);
            $data['subject'] = stripslashes($data['subject']);
            $data['subject'] = htmlspecialchars($data['subject']);
            if (empty($data['subject']) || is_null($data['subject']) || $data['subject'] == '') {
                $error['subject'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_SUBJECT_REQUIRED');
            }
        } else {
            $error['subject'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_SUBJECT_REQUIRED');
        }
        if (isset($data['email'])) {
            $data['email'] = strip_tags($data['email']);
            $data['email'] = trim($data['email']);
            if (empty($data['email']) || is_null($data['email']) || $data['email'] == '') {
                $error['email'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EMAIL_REQUIRED');
            } else {
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $error['email'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EMAIL_INVALID');
                }
            }
        } else {
            $error['email'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_EMAIL_REQUIRED');
        }
        if (isset($data['message'])) {
            $data['message'] = trim($data['message']);
            $temp = strip_tags($data['message']);
            $temp = html_entity_decode($temp);
            $temp = preg_replace('~\x{00a0}~siu', '', $temp);
            if (empty($temp) || is_null($temp) || $temp == '') {
                $error['message'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_MESSAGE_REQUIRED');
            } else {
                $allowed = '<span><br><i><b><a><img><h1><h2><ul><ol><li>';
                $data['message'] = strip_tags($data['message'], $allowed);
            }
        } else {
            $error['message'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_MESSAGE_REQUIRED');
        }
        if (isset($data['token'])) {
            $token_array = sc_get_token_array();
            if (empty($data['token']) || is_null($data['token']) || $data['token'] == '') {
                $data['valid'] = false;
                $data['error'] = array('invalid_form' => sc_i18n($thisfile_sc, $sc_language, 'SC_FE_INVALID_FORM_SUBMIT'));
                sc_log_attempts('invalid_token', json_encode($token_array), '');
                return $data;
            } else {
                if (!in_array($data['token'], $token_array)) {
                    $data['valid'] = false;
                    $data['error'] = array('invalid_form' => sc_i18n($thisfile_sc, $sc_language, 'SC_FE_INVALID_FORM_SUBMIT'));
                    sc_log_attempts('invalid_token', json_encode($token_array), $data['token']);
                    return $data;
                }
            }
        } else {
            $data['valid'] = false;
            $data['error'] = array('invalid_form' => sc_i18n($thisfile_sc, $sc_language, 'SC_FE_INVALID_FORM_SUBMIT'));
            return $data;
        }
        if ($settings['captcha_type'] == 1) {
            if ($settings['recaptcha_status'] == 1) {
                require_once GSPLUGINPATH . 'getsimple_contact/inc/recaptchalib.php';
                if (isset($data['recaptcha_challenge_field']) && isset($data['recaptcha_response_field'])) {
                    $privatekey = $settings['recaptcha_private_key'];
                    $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $data["recaptcha_challenge_field"], $data["recaptcha_response_field"]);
                    if (!$resp->is_valid) {
                        $error['captcha'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_' . strtoupper($resp->error));
                    }
                } else {
                    $error['captcha'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_INCORRECT-CAPTCHA-SOL');
                }
            }
        } else if ($settings['captcha_type'] == 0) {
            if (isset($data['opencaptcha_challenge_field']) && isset($data['opencaptcha_response_field'])) {
                $check = sc_check_opencaptcha($data['opencaptcha_response_field'], $data['opencaptcha_challenge_field']);
                if (!$check) {
                    $error['captcha'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_INCORRECT-CAPTCHA-SOL');
                }
            } else {
                $error['captcha'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_INCORRECT-CAPTCHA-SOL');
            }
        }
        if (isset($data['attachment']) && count($data['attachment']) <= 5 && !empty($data['attachment']['name'])) {
            $max_size = 1048576;
            $allowed_type = array('text/plain','application/vnd.ms-excel','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-powerpoint',
                                    'application/vnd.openxmlformats-officedocument.presentationml.presentation','application/vnd.openxmlformats-officedocument.presentationml.slideshow',
                                    'application/vnd.oasis.opendocument.text','application/x-vnd.oasis.opendocument.text','application/pdf','image/jpeg','image/jpg','image/gif','image/png','image/bmp');
            if (count($data['attachment']) == 5) {
                if ($data['attachment']['error'] == 0) {
                    if (!in_array($data['attachment']['type'], $allowed_type)) {
                        $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_TYPE_DISABLED');
                    } else if ($data['attachment']['size']>$max_size) {
                        $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_SIZE_EXCEEDED');
                    }
                } else {
                    switch ($data['attachment']['error']) {
                        case 1:
                            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_ERROR_1');
                            break;
                        case 2:
                            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_ERROR_2');
                            break;
                        case 3:
                            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_ERROR_3');
                            break;
                        case 4:
                            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_ERROR_4');
                            break;
                        case 6:
                            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_ERROR_6');
                            break;
                        case 7:
                            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_ERROR_7');
                            break;
                        case 8:
                            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_ERROR_8');
                            break;
                        default:
                            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_ERROR_UNKNOWN');
                            break;
                    }
                }
            }
        } else if (isset($data['attachment']) && count($data['attachment']) > 5 && !empty($data['attachment']['name'])) {
            $error['attachment'] = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_ATTACHMENT_EXCEEDED');
        }
        if (count($error) > 0) {
            $data['valid'] = false;
            $data['error'] = $error;
            return $data;
        } else {
            $data['valid'] = true;
            return $data;
        }
    } else {
        $data['valid'] = false;
        $data['error'] = array('invalid_form' => sc_i18n($thisfile_sc, $sc_language, 'SC_FE_INVALID_FORM_SUBMIT'));
        return $data;
    }
}

function sc_save_settings($data) {
    $xml = new SimpleXMLExtended('<ITEM></ITEM>');
    $xml->addChild('SUPERADMIN_NAME', $data['superadmin_name']);
    $xml->addChild('SUPERADMIN_EMAIL', $data['superadmin_email']);
    $xml->addChild('RECIPIENT_NAME', $data['recipient_name']);
    $xml->addChild('RECIPIENT_EMAIL', $data['recipient_email']);
    $xml->addChild('CC_STATUS', $data['cc_status']);
    $xml->addChild('ATTACHMENTS_STATUS', $data['attachments_status']);
    $xml->addChild('WYSIHTML5_EDITOR', $data['wysihtml5_editor']);
    $xml->addChild('CAPTCHA_TYPE', $data['captcha_type']);
    $xml->addChild('RECAPTCHA_STATUS', $data['recaptcha_status']);
    $xml->addChild('RECAPTCHA_PUBLIC_KEY', $data['recaptcha_public_key']);
    $xml->addChild('RECAPTCHA_PRIVATE_KEY', $data['recaptcha_private_key']);
    $xml->addChild('SMTP_STATUS', $data['smtp_status']);
    $xml->addChild('SMTP_HOST', $data['smtp_host']);
    $xml->addChild('SMTP_PORT', $data['smtp_port']);
    $xml->addChild('SMTP_AUTH', $data['smtp_auth']);
    $xml->addChild('SMTP_USERNAME', $data['smtp_username']);
    $xml->addChild('SMTP_PASSWORD', sc_encrypt_smtp_password($data['smtp_password']));

    if (!XMLsave($xml, GSDATAOTHERPATH . 'getsimple_contact_settings.xml')) {
        $error = '<div class="error"><p>' . i18n_r('CHMOD_ERROR') . '</p></div>';
        echo $error;
    } else {
        $success = '<div class="updated"><p>' . i18n_r('SETTINGS_UPDATED') . '</p></div>';
        echo $success;
    }
}

function sc_get_settings() {
    global $settings_file;
    if (file_exists($settings_file)) {
        $settings = getXML($settings_file);
    } else {
        $xml = new SimpleXMLExtended('<ITEM></ITEM>');
        $xml->addChild('SUPERADMIN_NAME', 'Superadmin Name');
        $xml->addChild('SUPERADMIN_EMAIL', 'superadmin@email.com');
        $xml->addChild('RECIPIENT_NAME', 'Recipient Name');
        $xml->addChild('RECIPIENT_EMAIL', 'recipient@email.com');
        $xml->addChild('CC_STATUS', 0);
        $xml->addChild('ATTACHMENTS_STATUS', 0);
        $xml->addChild('WYSIHTML5_EDITOR', 1);
        $xml->addChild('CAPTCHA_TYPE', 0);
        $xml->addChild('RECAPTCHA_STATUS', 0);
        $xml->addChild('RECAPTCHA_PUBLIC_KEY', '6Ldz6OgSAAAAAGgYwOZEH4E-9V0EK9e8zjmVmMoi');
        $xml->addChild('RECAPTCHA_PRIVATE_KEY', '6Ldz6OgSAAAAADR6CmMpe6qUEgLeQ7xCQ-5FUqAC');
        $xml->addChild('SMTP_STATUS', 0);
        $xml->addChild('SMTP_HOST', 'localhost');
        $xml->addChild('SMTP_PORT', 25);
        $xml->addChild('SMTP_AUTH', 0);
        $xml->addChild('SMTP_USERNAME', '');
        $xml->addChild('SMTP_PASSWORD', '');

        if (!XMLsave($xml, GSDATAOTHERPATH . 'getsimple_contact_settings.xml')) {
            $error = '<div class="error"><p>' . i18n_r('CHMOD_ERROR') . '</p></div>';
        } else {
            $settings = getXML($settings_file);
            $success = '<div class="updated"><p>' . i18n_r('SETTINGS_UPDATED') . '</p></div>';
        }
    }
    $data = array('superadmin_name' => $settings->SUPERADMIN_NAME,
        'superadmin_email' => $settings->SUPERADMIN_EMAIL,
        'recipient_name' => $settings->RECIPIENT_NAME,
        'recipient_email' => $settings->RECIPIENT_EMAIL,
        'cc_status' => $settings->CC_STATUS,
        'attachments_status' => $settings->ATTACHMENTS_STATUS,
        'wysihtml5_editor' => $settings->WYSIHTML5_EDITOR,
        'captcha_type' => $settings->CAPTCHA_TYPE,
        'recaptcha_status' => $settings->RECAPTCHA_STATUS,
        'recaptcha_public_key' => $settings->RECAPTCHA_PUBLIC_KEY,
        'recaptcha_private_key' => $settings->RECAPTCHA_PRIVATE_KEY,
        'smtp_status' => $settings->SMTP_STATUS,
        'smtp_host' => $settings->SMTP_HOST,
        'smtp_port' => $settings->SMTP_PORT,
        'smtp_auth' => $settings->SMTP_AUTH,
        'smtp_username' => $settings->SMTP_USERNAME,
        'smtp_password' => $settings->SMTP_PASSWORD
        );
    return $data;
}

function sc_be_content() {
    global $thisfile_sc, $SITEURL, $sc_language;
    require_once GSPLUGINPATH . 'getsimple_contact/inc/class.template.php';
    $settings = sc_get_settings();
    if ($settings['recaptcha_status'] == 0) {
        $disabled = ' selected';
        $enabled = '';
    } else if ($settings['recaptcha_status'] == 1) {
        $disabled = '';
        $enabled = ' selected';
    }
    if ($settings['captcha_type'] == 0) {
        $current0 = ' selected';
        $current1 = '';
        $current2 = '';
    } else if ($settings['captcha_type'] == 1) {
        $current0 = '';
        $current1 = ' selected';
        $current2 = '';
    } else if ($settings['captcha_type'] == 2) {
        $current0 = '';
        $current1 = '';
        $current2 = ' selected';
    }
    if ($settings['wysihtml5_editor'] == 0) {
        $wysihtml5_on = '';
        $wysihtml5_off = ' selected';
    } else if ($settings['wysihtml5_editor'] == 1) {
        $wysihtml5_on = ' selected';
        $wysihtml5_off = '';
    }
    if ($settings['cc_status'] == 0) {
        $cc_status_on = '';
        $cc_status_off = ' selected';
    } else if ($settings['cc_status'] == 1) {
        $cc_status_on = ' selected';
        $cc_status_off = '';
    }
    if ($settings['attachments_status'] == 0) {
        $attachments_status_on = '';
        $attachments_status_off = ' selected';
    } else if ($settings['attachments_status'] == 1) {
        $attachments_status_on = ' selected';
        $attachments_status_off = '';
    }
    if ($settings['smtp_status'] == 0) {
        $smtp_status_on = '';
        $smtp_status_off = ' selected';
    } else if ($settings['smtp_status'] == 1) {
        $smtp_status_on = ' selected';
        $smtp_status_off = '';
    }
    if ($settings['smtp_auth'] == 0) {
        $smtp_auth_on = '';
        $smtp_auth_off = ' selected';
    } else if ($settings['smtp_auth'] == 1) {
        $smtp_auth_on = ' selected';
        $smtp_auth_off = '';
    }
    $backend = new SCTemplate(GSPLUGINPATH . 'getsimple_contact/templates/backend.form.tpl');
    $backend->set('BE_SUPERADMIN_NAME', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SUPERADMIN_NAME'));
    $backend->set('BE_SUPERADMIN_NAME_SETTINGS', $settings['superadmin_name']);
    $backend->set('BE_SUPERADMIN_EMAIL', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SUPERADMIN_EMAIL'));
    $backend->set('BE_SUPERADMIN_EMAIL_SETTINGS', $settings['superadmin_email']);
    $backend->set('BE_SUPERADMIN_DESC', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SUPERADMIN_DESC'));
    $backend->set('BE_RECIPIENT_NAME', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECIPIENT_NAME'));
    $backend->set('BE_RECIPIENT_NAME_SETTINGS', $settings['recipient_name']);
    $backend->set('BE_RECIPIENT_EMAIL', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECIPIENT_EMAIL'));
    $backend->set('BE_RECIPIENT_EMAIL_SETTINGS', $settings['recipient_email']);
    $backend->set('BE_SMTP_STATUS', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_STATUS'));
    $backend->set('BE_SMTP_OFF', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_OFF'));
    $backend->set('BE_SMTP_ON', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_ON'));
    $backend->set('BE_SMTP_SELECTED_OFF', $smtp_status_off);
    $backend->set('BE_SMTP_SELECTED_ON', $smtp_status_on);
    $backend->set('BE_SMTP_AUTH', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_AUTH'));
    $backend->set('BE_SMTP_AUTH_OFF', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_AUTH_OFF'));
    $backend->set('BE_SMTP_AUTH_ON', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_AUTH_ON'));
    $backend->set('BE_SMTP_AUTH_SELECTED_OFF', $smtp_auth_off);
    $backend->set('BE_SMTP_AUTH_SELECTED_ON', $smtp_auth_on);
    $backend->set('BE_SMTP_HOST', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_HOST'));
    $backend->set('BE_SMTP_HOST_SETTINGS', $settings['smtp_host']);
    $backend->set('BE_SMTP_PORT', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_PORT'));
    $backend->set('BE_SMTP_PORT_SETTINGS', $settings['smtp_port']);
    $backend->set('BE_SMTP_USERNAME', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_USERNAME'));
    $backend->set('BE_SMTP_USERNAME_SETTINGS', $settings['smtp_username']);
    $backend->set('BE_SMTP_PASSWORD', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_SMTP_PASSWORD'));
    $backend->set('BE_CC_STATUS', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_CC_STATUS'));
    $backend->set('BE_CC_OFF', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_CC_OFF'));
    $backend->set('BE_CC_ON', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_CC_ON'));
    $backend->set('BE_CC_SELECTED_OFF', $cc_status_off);
    $backend->set('BE_CC_SELECTED_ON', $cc_status_on);
    $backend->set('BE_ATTACHMENTS_STATUS', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_ATTACHMENTS_STATUS'));
    $backend->set('BE_ATTACHMENTS_OFF', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_ATTACHMENTS_OFF'));
    $backend->set('BE_ATTACHMENTS_ON', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_ATTACHMENTS_ON'));
    $backend->set('BE_ATTACHMENTS_SELECTED_OFF', $attachments_status_off);
    $backend->set('BE_ATTACHMENTS_SELECTED_ON', $attachments_status_on);
    $backend->set('BE_WYSIHTML5_EDITOR', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_WYSIHTML5_EDITOR'));
    $backend->set('BE_WYSIHTML5_EDITOR_OFF', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_WYSIHTML5_EDITOR_OFF'));
    $backend->set('BE_WYSIHTML5_EDITOR_ON', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_WYSIHTML5_EDITOR_ON'));
    $backend->set('BE_WYSIHTML5_EDITOR_SELECTED_OFF', $wysihtml5_off);
    $backend->set('BE_WYSIHTML5_EDITOR_SELECTED_ON', $wysihtml5_on);
    $backend->set('BE_CAPTCHA_TYPE', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_CAPTCHA_TYPE'));
    $backend->set('BE_CAPTCHA_SELECT_OPENCAPTCHA', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_CAPTCHA_SELECT_OPENCAPTCHA'));
    $backend->set('BE_CAPTCHA_SELECT_RECAPTCHA', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_CAPTCHA_SELECT_RECAPTCHA'));
    $backend->set('BE_CAPTCHA_SELECT_NOCAPTCHA', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_CAPTCHA_SELECT_NOCAPTCHA'));
    $backend->set('BE_CAPTCHA_SELECT_OPENCAPTCHA_SELECTED', $current0);
    $backend->set('BE_CAPTCHA_SELECT_RECAPTCHA_SELECTED', $current1);
    $backend->set('BE_CAPTCHA_SELECT_NOCAPTCHA_SELECTED', $current2);
    $backend->set('BE_OPENCAPTCHA_DESC', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_OPENCAPTCHA_DESC'));
    $backend->set('BE_OPENCAPTCHA_LINK', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_OPENCAPTCHA_LINK'));
    $backend->set('BE_RECAPTCHA_STATUS', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECAPTCHA_STATUS'));
    $backend->set('BE_RECAPTCHA_SELECT_DISABLED', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECAPTCHA_SELECT_DISABLED'));
    $backend->set('BE_RECAPTCHA_SELECT_ENABLED', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECAPTCHA_SELECT_ENABLED'));
    $backend->set('BE_RECAPTCHA_SELECT_DISABLED_SELECTED', $disabled);
    $backend->set('BE_RECAPTCHA_SELECT_ENABLED_SELECTED', $enabled);
    $backend->set('BE_RECAPTCHA_PUBLIC_KEY', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECAPTCHA_PUBLIC_KEY'));
    $backend->set('BE_RECAPTCHA_PUBLIC_KEY_SETTINGS', $settings['recaptcha_public_key']);
    $backend->set('BE_RECAPTCHA_PRIVATE_KEY', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECAPTCHA_PRIVATE_KEY'));
    $backend->set('BE_RECAPTCHA_PRIVATE_KEY_SETTINGS', $settings['recaptcha_private_key']);
    $backend->set('BE_RECAPTCHA_DESC', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECAPTCHA_DESC'));
    $backend->set('BE_RECAPTCHA_LINK', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_RECAPTCHA_LINK'));
    $backend->set('FE_BE_SUBMIT', sc_i18n($thisfile_sc, $sc_language, 'SC_FE_BE_SUBMIT'));
    $backend->set('BE_ICONS_LINK', sc_i18n($thisfile_sc, $sc_language, 'SC_BE_ICONS_LINK'));
    $backend->set('BE_SCRIPTS', '<script>window.jQuery || document.write(\'<script src="' . $SITEURL . 'plugins/getsimple_contact/js/jquery-1.10.2.min.js"><\/script>\')</script>');
    return $backend->output();
}

function sc_be_update_settings($data) {
    $settings = sc_get_settings();
    $old = count($settings);
    foreach ($data as $key => $value) {
        foreach ($value as $key2 => $value2) {
            if (empty($settings[$key2])) {
                $settings[$key2] = $value2;
                sc_save_settings($settings);
            }
        }
    }
    $new = count($settings);
    if ($new > $old) {
        return true;
    } else {
        return false;
    }
}

function sc_get_recipients() {
    $settings = sc_get_settings();
    $nameArray = explode(',', $settings['recipient_name']);
    $emailArray = explode(',', $settings['recipient_email']);
    foreach ($nameArray as $key => $value) {
        if ($value == '' || empty($value) || is_null($value)) {
            unset($nameArray[$key]);
        }
    }
    foreach ($emailArray as $key => $value) {
        if ($value == '' || empty($value) || is_null($value)) {
            unset($emailArray[$key]);
        }
    }
    $na = count($nameArray);
    $ea = count($emailArray);
    $new = array();
    if ($na == $ea) {
        for ($i = 0; $i < $na; $i++) {
            $new[$i] = array(trim($emailArray[$i]) => trim($nameArray[$i]));
        }
    } else if ($na > $ea) {
        for ($i = 0; $i < $ea; $i++) {
            $new[$i] = array(trim($emailArray[$i]) => trim($nameArray[$i]));
        }
    } else if ($ea > $na) {
        for ($i = 0; $i < $na; $i++) {
            $new[$i] = array(trim($emailArray[$i]) => trim($nameArray[$i]));
        }
    }
    return $new;
}

function sc_check_opencaptcha($opencaptcha_response_field, $opencaptcha_challenge_field) {
    if (sc_file_get_contents("http://www.opencaptcha.com/validate.php?ans=" . $opencaptcha_response_field . "&img=" . $opencaptcha_challenge_field) == 'pass') {
        return true;
    } else {
        return false;
    }
}

function sc_file_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function sc_is_whitelisted($data) {
    $settings = sc_get_settings();
    $whitelist = array('name', 'subject', 'email', 'message', '_wysihtml5_mode',
        'recaptcha_response_field', 'recaptcha_challenge_field',
        'opencaptcha_response_field', 'opencaptcha_challenge_field',
        'attachment', 'token', 'submit');
    if ($settings['captcha_type'] == 0) {
        unset($whitelist[5]);
        unset($whitelist[6]);
    } else if ($settings['captcha_type'] == 1) {
        if ($settings['recaptcha_status'] == 1) {
            unset($whitelist[7]);
            unset($whitelist[8]);
        } else {
            unset($whitelist[5]);
            unset($whitelist[6]);
            unset($whitelist[7]);
            unset($whitelist[8]);
        }
    } else {
        unset($whitelist[5]);
        unset($whitelist[6]);
        unset($whitelist[7]);
        unset($whitelist[8]);
    }
    if ($settings['attachments_status'] == 0) {
        unset($whitelist[9]);
    }
    foreach ($data as $key => $value) {
        if (!in_array($key, $whitelist)) {
            sc_log_attempts('invalid_form_data', $whitelist, $data);
            return false;
        }
    }
    return true;
}

function sc_log_attempts($type, $param1 = null, $param2 = null) {
    global $thisfile_sc, $SITEURL, $sc_language;
    require_once GSPLUGINPATH . 'getsimple_contact/inc/class.phpmailer.php';
    require_once GSPLUGINPATH . 'getsimple_contact/inc/class.html2text.php';
    $settings = sc_get_settings();
    $ip = $_SERVER['REMOTE_ADDR'];
    $host = gethostbyaddr($ip);
    $date = date('Y. m. d. H:i');
    if ($type == 'invalid_form_data') {
        $enabled = '';
        $posted = '';
        foreach ($param1 as $key => $value) {
            $enabled .= $value . ', ';
        }
        foreach ($param2 as $key => $value) {
            $posted .= $key . ', ';
        }
    } else {
        $enabled = '';
        $posted = '';
    }
    $enabled = substr($enabled, 0, -2);
    $posted = substr($posted, 0, -2);
    $subject = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_SUBJECT_START') . get_site_name(false) . sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_SUBJECT_END');
    $log = sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_START') . get_site_name(false) . ' - ' . get_page_clean_title(false) . sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_END') . '<br/><br/>';
    $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_DETAILS') . '<br/>';
    $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_DATE') . $date . '<br/>';
    $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_SITE') . $SITEURL . '<br/>';
    $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_IP') . $ip . '<br/>';
    $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_HOST') . $host . '<br/>';
    $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_TYPE') . $type . '<br/>';
    if ($type == 'invalid_form_data') {
        $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_WHITELIST') . $enabled . '<br/>';
        $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_POSTED') . $posted . '<br/>';
    } else if ($type == 'invalid_token') {
        $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_CORRECT_TOKEN') . $param1 . '<br/>';
        $log .= sc_i18n($thisfile_sc, $sc_language, 'SC_FE_LOG_MESSAGE_FALSE_TOKEN') . $param2 . '<br/>';
    }
    $nonHTML = new html2text($log);
    $mail = new PHPMailer;
    if ($settings['smtp_status'] == 1) {
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host       = $settings['smtp_host'];
        $mail->Port       = $settings['smtp_port'];
        if ($settings['smtp_auth'] == 1) {
            $mail->SMTPAuth   = true;
            $mail->Username   = $settings['smtp_username'];
            $mail->Password   = sc_decrypt_smtp_password($settings['smtp_password']);
            if ($settings['smtp_host']=='smtp.gmail.com' && $settings['smtp_port']==465) {
                $mail->SMTPSecure = 'ssl';
            } else if ($settings['smtp_host']=='smtp.gmail.com' && $settings['smtp_port']==587) {
                $mail->SMTPSecure = 'tls';
            }
        }

    } else {
        $mail->setLanguage('en_US', GSPLUGINPATH . 'getsimple_contact/lang/');
    }
    $mail->CharSet = 'UTF-8';
    $mail->From = $settings['superadmin_email'];
    $mail->FromName = $settings['superadmin_name'];
    $mail->addAddress($settings['superadmin_email'], $settings['superadmin_name']);
    $mail->WordWrap = 50;
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $log;
    $mail->AltBody = $nonHTML->get_text();
    $mail->send();
}

function sc_generate_token() {
    if (!isset($_SESSION)) {
        @session_start();
    }
    if (isset($_SESSION['token'][1]) && !isset($_SESSION['token'][2]) && !isset($_SESSION['token'][3]) && !isset($_SESSION['token'][4])) {
        $_SESSION['token'][2] = $_SESSION['token'][1];
        $_SESSION['token'][1] = md5(uniqid(microtime(), true));
    } else if (isset($_SESSION['token'][1]) && isset($_SESSION['token'][2]) && !isset($_SESSION['token'][3]) && !isset($_SESSION['token'][4])) {
        $_SESSION['token'][3] = $_SESSION['token'][2];
        $_SESSION['token'][2] = $_SESSION['token'][1];
        $_SESSION['token'][1] = md5(uniqid(microtime(), true));
    } else if (isset($_SESSION['token'][1]) && isset($_SESSION['token'][2]) && isset($_SESSION['token'][3]) && !isset($_SESSION['token'][4])) {
        $_SESSION['token'][4] = $_SESSION['token'][3];
        $_SESSION['token'][3] = $_SESSION['token'][2];
        $_SESSION['token'][2] = $_SESSION['token'][1];
        $_SESSION['token'][1] = md5(uniqid(microtime(), true));
    } else if (isset($_SESSION['token'][1]) && isset($_SESSION['token'][2]) && isset($_SESSION['token'][3]) && isset($_SESSION['token'][4])) {
        $_SESSION['token'][5] = $_SESSION['token'][4];
        $_SESSION['token'][4] = $_SESSION['token'][3];
        $_SESSION['token'][3] = $_SESSION['token'][2];
        $_SESSION['token'][2] = $_SESSION['token'][1];
        $_SESSION['token'][1] = md5(uniqid(microtime(), true));
    } else {
        $_SESSION['token'][1] = md5(uniqid(microtime(), true));
    }
}

function sc_get_token() {
    return $_SESSION['token'][1];
}

function sc_get_token_array() {
    return $_SESSION['token'];
}

function sc_language() {
    global $thisfile_sc;
    if (isset($_GET['setlang']) && substr($_GET['setlang'], 0, 2) != '') {
            sc_i18n_merge($thisfile_sc, substr($_GET['setlang'], 0, 2), strtoupper(substr($_GET['setlang'], 0, 2)) . '_');
            $sc_language = substr($_GET['setlang'], 0, 2) . '_';
    } else if (isset($_COOKIE['language'])) {
        if (isset($_GET['lang']) && substr($_GET['lang'], 0, 2) != '') {
            sc_i18n_merge($thisfile_sc, substr($_GET['lang'], 0, 2), strtoupper(substr($_GET['lang'], 0, 2)) . '_');
            $sc_language = substr($_GET['lang'], 0, 2) . '_';
        } else {
            sc_i18n_merge($thisfile_sc, substr($_COOKIE['language'], 0, 2), strtoupper(substr($_COOKIE['language'], 0, 2)) . '_');
            $sc_language = substr($_COOKIE['language'], 0, 2) . '_';
        }
    } else if (isset($_GET['lang']) && substr($_GET['lang'], 0, 2) != '') {
        sc_i18n_merge($thisfile_sc, substr($_GET['lang'], 0, 2), strtoupper(substr($_GET['lang'], 0, 2)) . '_');
        $sc_language = substr($_GET['lang'], 0, 2) . '_';
    } else {
        $sc_language = '';
    }
    return strtoupper($sc_language);
}

function sc_i18n_merge($plugin, $language, $lang_prefix) {
    global $i18n, $LANG;
    return sc_i18n_merge_impl($plugin, $language ? $language : $LANG, $i18n, $lang_prefix);
}

function sc_i18n_merge_impl($plugin, $lang, &$globali18n, $lang_prefix) {
    $i18n = array();
    $plugin_lang_array = sc_get_files(GSPLUGINPATH . $plugin . '/lang/');
    $newlang = null;
    foreach ($plugin_lang_array as $key => $value) {
        if (substr($value, 0, 2)==$lang) {
            $newlang = $value;
        }
    }
    $filename = ($plugin ? GSPLUGINPATH . $plugin . '/lang/' : GSLANGPATH) . (!is_null($newlang) ? $newlang : 'en_US.php');
    $prefix = $plugin ? $plugin . '/' . $lang_prefix : '';
    if (!file_exists($filename)) {
        return false;
    }
    @include($filename);
    if (count($i18n) > 0)
        foreach ($i18n as $code => $text) {
            if (!array_key_exists($prefix . $code, $globali18n)) {
                $globali18n[$prefix . $code] = $text;
            }
        }
    return true;
}

function sc_i18n($plugin, $lang_prefix, $name) {
    global $i18n;
    global $LANG;

    if (!isset($i18n))
        return;

    $normal = $plugin . '/' . $name;
    $prefixed = $plugin . '/' . $lang_prefix . $name;
    if (array_key_exists($prefixed, $i18n)) {
        $myVar = $i18n[$prefixed];
    } else {
        if (array_key_exists($normal, $i18n)) {
            $myVar = $i18n[$normal];
        } else {
            $myVar = '{'.$normal.'}';
        }
    }
    return $myVar;
}

function sc_get_component($page) {
        $content = returnPageContent(return_page_slug(), 'content', false, true);
	$content = strip_decode($content);
        if (!preg_match('#\[sc_form(.*)\]#', $content)) {
            getPageContent($page);
        }
}

function sc_get_files($path) {
	$handle = opendir($path) or die("sc_get_files: Unable to open $path");
	$file_arr = array();
	while ($file = readdir($handle)) {
		if ($file != '.' && $file != '..' && $file != '.htaccess' && strlen($file)==9) {
			$file_arr[] = $file;
		}
	}
	closedir($handle);
	return $file_arr;
}

function sc_encrypt_smtp_password($data) {
    if (!empty($data)) {
        $return = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(SC_SMTPSALT.SC_SMTPPEPPER), $data, MCRYPT_MODE_CBC, md5(md5(SC_SMTPSALT.SC_SMTPPEPPER))));
        return $return;
    } else {
        return $data;
    }
}

function sc_decrypt_smtp_password($data) {
    if (!empty($data)) {
        $data = str_replace("%3D", "=",$data);
        $return = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(SC_SMTPSALT.SC_SMTPPEPPER), base64_decode($data), MCRYPT_MODE_CBC, md5(md5(SC_SMTPSALT.SC_SMTPPEPPER))), "\0");
        return $return;
    } else {
        return $data;
    }
}
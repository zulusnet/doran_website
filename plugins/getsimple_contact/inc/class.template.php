<?php

class SCTemplate {

    protected $thisfile_sc;
    protected $sc_language;
    protected $template;
    protected $content = array();

    public function __construct($template_file, $thisfile_sc='getsimple_contact',$sc_language='') {
        $this->thisfile_sc = $thisfile_sc;
        $this->sc_language = $sc_language;
        $this->template = $template_file;
    }

    public function set($key, $value) {
        $this->content[$key] = $value;
    }

    public function output() {
        if (!file_exists($this->template)) {
            return sc_i18n($this->thisfile_sc,$this->sc_language,'SC_TEMPLATE_NOT_FOUND');
        }
        $output = file_get_contents($this->template);

        foreach ($this->content as $key => $value) {
            $tagToReplace = "[SC_$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }

    static public function merge($templates, $separator = '\n') {
        $output = '';
        foreach ($templates as $template) {
            $content = (get_class($template) !== 'Template') ? sc_i18n($this->thisfile_sc,$this->sc_language,'SC_TEMPLATE_INCORRECT_TYPE') : $template->output();
            $output .= $content . $separator;
        }

        return $output;
    }

}

?>
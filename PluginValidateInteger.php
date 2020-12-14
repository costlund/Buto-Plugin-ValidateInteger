<?php
class PluginValidateInteger{
  private $i18n = null;
  function __construct() {
    wfPlugin::includeonce('i18n/translate_v1');
    $this->i18n = new PluginI18nTranslate_v1();
    $this->i18n->setPath('/plugin/validate/integer/i18n');
  }
  public function validate_integer($field, $form, $data = array()){
    if(wfArray::get($form, "items/$field/is_valid") && strlen(wfArray::get($form, "items/$field/post_value"))){ // Only if valid and has data.
      if (!$this->is_integer(wfArray::get($form, "items/$field/post_value"))) {
        $form = wfArray::set($form, "items/$field/is_valid", false);
        $form = wfArray::set($form, "items/$field/errors/", $this->i18n->translateFromTheme('?label is not an integer!', array('?label' => wfArray::get($form, "items/$field/label"))));
      }
    }
    return $form;    
  }
  private function is_integer($num){
    if(preg_match('/^\d+$/',$num)){
      return true;
    }else{
      return false;
    }
  }
}

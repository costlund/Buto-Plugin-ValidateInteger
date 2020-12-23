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
      wfPlugin::includeonce('wf/array');
      $data = new PluginWfArray($data);
      if (!$this->is_integer(wfArray::get($form, "items/$field/post_value"))) {
        $form = wfArray::set($form, "items/$field/is_valid", false);
        $form = wfArray::set($form, "items/$field/errors/", $this->i18n->translateFromTheme('?label is not an integer!', array('?label' => wfArray::get($form, "items/$field/label"))));
      }elseif(strlen($data->get('min')) && (int)wfArray::get($form, "items/$field/post_value") < $data->get('min')){
        $form = wfArray::set($form, "items/$field/is_valid", false);
        $form = wfArray::set($form, "items/$field/errors/", $this->i18n->translateFromTheme('?label can not be less then ?min!', array('?label' => wfArray::get($form, "items/$field/label"), '?min' => $data->get('min'))));
      }elseif(strlen($data->get('max')) && (int)wfArray::get($form, "items/$field/post_value") > $data->get('max')){
        $form = wfArray::set($form, "items/$field/is_valid", false);
        $form = wfArray::set($form, "items/$field/errors/", $this->i18n->translateFromTheme('?label can not be greater then ?max!', array('?label' => wfArray::get($form, "items/$field/label"), '?max' => $data->get('max'))));
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

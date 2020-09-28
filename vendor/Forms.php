<?php

namespace vendor;

class Forms
{
    public $form;
    public $formname;
    function __construct($method, $formname, $action=NULL){
        $this->formname = $formname;
        $this->form     = "<form enctype='application/x-www-form-urlencoded' method='$method' action='$action'></form>";
    }

    function inputText($name, $value=NULL, $placeholder=NULL, $required=NULL){
        if($required) $required = 'required';

        $this->form = str_replace('</form>', 
            "<input type='text' name='$name' value='$value' placeholder='$placeholder' $required></form>", 
            $this->form);
    }

    function inputFile($name, $multiple=NULL, $accept=NULL){
        $this->form = str_replace('application/x-www-form-urlencoded', 'multipart/form-data', $this->form);

        if($multiple) $required='multiple';

        $this->form = str_replace('</form>', 
            "<input type='file' name='$name' $multiple accept='$accept'></form>",
             $this->form);
    }

    function submit($value=NULL){
        $this->form = str_replace('</form>',
            "<input type='submit' value='$value'></form>",
            $this->form);
    }

    function saveFile($name){
        require $_SERVER['DOCUMENT_ROOT'].'/config.php';
        $upload_file = UPLOADING_FOLDER.basename($_FILES[$name]['tmp_name']).$_FILES[$name]['name'];
        echo $upload_file;
        if(move_uploaded_file($_FILES[$name]['tmp_name'],$upload_file)){
            return true;
        } else {
            return false;
        }
    }
}
<?php 

class Button {

    public static function CButton(){
        $button = "<md-button></md-button>";

    }
    public function Flat($title,$disabled,$class,$nolink=NULL){
        $button = "<md-button";
        $button .= $disabled=='True' ? '  ng-disabled="true"'   :'';
        $button .= strlen($class)>2 ? ' class="md-raised '.$class.'"'  : ' class="md-primary"' ;
        $button .= isset($nolink) ?  '  md-no-ink class = "md-primary"'  : '';
        $button .= ">";
        $button.= strlen($title)>2 ? trim($title) : "Button";
        $button.= "</md-button>";
        echo  $button;
    }


}
// $btn  = new Button();
// $btn->Flat("New Creation","False","md-warn");
















?>
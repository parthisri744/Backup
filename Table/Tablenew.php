<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <title></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://rawgit.com/daniel-nagy/md-data-table/master/dist/md-data-table.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="Table.js"></script>
</head>
<body ng-controller="myController" layout="column" ng-init="loadData()">
<md-card>
<?php
function TableButton($btn){  
    if(is_array($btn)){
        foreach($btn as $btnobj){  
            if($btnobj->type=="link"){ ?>
            <md-button class="md-raised " ng-model="<?php echo $btnobj->name ?>" style="color:white;background-color:<?php echo $btnobj->class ?>" <?php if(strlen($btnobj->link)>2) { echo "ng-href='". $btnobj->link."'"; } ?> > <?php echo $btnobj->title ?></md-button><?php
             }elseif($btnobj->type=="static"){   ?>
            <md-button style="color:white;background-color:<?php echo $btnobj->class ?>" ><?php echo $btnobj->title ?> </md-button><?php
             }elseif($btnobj->type=="refresh"){  ?>
            <md-button class="md-icon-button md-raised md-accent" style="color:white;background-color:<?php echo $btnobj->class ?>" ng-click="<?php echo $btnobj->click;  ?>"><md-icon>refresh</md-icon></md-button><?php
             }
         }
    }
}
    ?>
<?php 
function TableHead($title,$btn=NULL){  ?>
    <md-toolbar class="md-whiteframe-1dp">
     <div class="md-toolbar-tools">
         <div class="md-title"><?php  echo $title  ?></div>
         <div flex></div>
         <?php  TableButton($btn);  ?>
     </div>
 </md-toolbar>
 <?php  TableClientFilter();  ?>
<?php
}
function TableBody(){

}

function TableFooter(){





}

function TableServerFilter(){




}
function TableClientFilter(){  ?>
    <div layout="row" layout-wrap>
      <md-input-container>
        <label>First name</label>
        <input type="text" ng-model="user.firstName">
      </md-input-container></div>
<?php
}


function script(){


}

function TableTheme(){




}

CreateTable();
function CreateTable(){
    $btn1   = new stdClass();
    $btn1->type = "static";
    $btn1->name = "new";
    $btn1->title = "New";
    $btn1->link = "";
    $btn1->class = "red";
    $btn2   = new stdClass();
    $btn2->type = "link";
    $btn2->name = "edit";
    $btn2->title = "Edit";
    $btn2->link = "https://facebook.com";
    $btn2->class = "blue";
    $btn3   = new stdClass();
    $btn3->name = "edit";
    $btn3->type = "refresh";
    $btn3->class = "green";
    $btn3->click = "loadStuff()";
    $btn = array($btn1,$btn2,$btn3); 
    $obj= new stdClass();
    $obj->head =  TableHead("Parthiban",$btn);
    return $obj;
}

TableBody();
?>
</md-card>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
    <script src="https://rawgit.com/daniel-nagy/md-data-table/master/dist/md-data-table.js"></script>
</body>
</html>
<script>

</script>
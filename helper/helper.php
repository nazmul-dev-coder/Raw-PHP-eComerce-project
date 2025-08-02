<?php
 
 class helper{

    public function formateDate($data){
        $date=date('F j,Y,g:i a',strtotime($data));
        return $date;
    }

    public function validation($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    public function path(){
        $path=$_SERVER['SCRIPT_FILENAME'];
        $name=basename($path,'.php');
        if($name=="index"){
            return  $title="Home";
        }elseif($name=='contact'){
            return  $title="Contact";
        }
        return false;
    }

    public function textShorten($data,$limit=400){
        $text=$data. " ";
        $text=substr($text,0,$limit);
        $text=substr($text,0,strrpos($text,' '));
        $text=$text.".....";
        return $text;
    }
 }



?>
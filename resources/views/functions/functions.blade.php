<?php
if (!function_exists('sub_text'))   {
    function sub_text($char,$text) {
        $title = $text;
        $title = mb_substr($title,0,$char);
        if(mb_strlen($title)<$char){
            $dotstree = "";
        }else{
            $dotstree = "...";
        }
        echo $title,$dotstree;
    }
}

?>

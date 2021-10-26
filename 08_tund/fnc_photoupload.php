<?php

    function save_image($image, $file_type, $target){
        $notice = null;
        
        if($file_type == "jpg"){
            if(imagejpeg($image, $target, 90)){
                $notice = "Pilt on salvestatud!";
            } else {
                $notice = "Pildi salvestamisel tekkis tõrge!";
            }
        }
        
        if($file_type == "png"){
            if(imagepng($image, $target, 6)){
                $notice = "Pilt on salvestatud!";
            } else {
                $notice = "Pildi salvestamisel tekkis tõrge!";
            }
        }
        
        if($file_type == "gif"){
            if(imagegif($image, $target)){
                $notice = "Pilt on salvestatud!";
            } else {
                $notice = "Pildi salvestamisel tekkis tõrge!";
            }
        }
        
        return $notice;
    }
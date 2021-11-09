<?php
    class Photoupload {
        private $photo_to_upload;
        private $file_type;//esialgu saadame selle siia laadimise lehelt, edaspidi teeb klass ise selle kindlaks
        private $my_temp_image;
        private $my_new_temp_image;
        
        function __construct($photo, $file_type){
            $this->photo_to_upload = $photo;
            $this->file_type = $file_type;
        }
    }//class lõppeb
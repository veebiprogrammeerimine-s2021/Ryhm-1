<?php
    //moodustame kasutajaprofiiliga seotud värvide jaoks CSS koodi
    //<style>
    //body {
    //  background-color: #AAAAAA;
    //  color: #0000AA;
    //}
    //</style>
    $css_color = "<style> \n";
    $css_color .= "body { \n";
    $css_color .= "\t background-color: " .$_SESSION["bg_color"] ."; \n";
    $css_color .= "\t color: " .$_SESSION["text_color"] ."; \n";
    $css_color .= "} \n </style> \n";
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</title>
    <?php echo $css_color; ?> 
</head>
<body>
    <img src="../pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
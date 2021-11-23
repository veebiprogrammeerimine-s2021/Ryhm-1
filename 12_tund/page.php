<?php
	session_start();
    require_once("../../../../config_vp_s2021.php");
    require_once("fnc_user.php");
    require_once("fnc_gallery.php");
	$author_name = "Andrus Rinde";
	
	//vaatan, mida POST meetodil saadeti
	//var_dump($_POST);
	
	$today_html = null; //$today_html = "";
	$today_adjective_error = null;
	$todays_adjective = null;
	//kontrollin, kas klikiti submit
	if(isset($_POST["submit_todays_adjective"])){
		//echo "Klikiti nuppu!";
		if(!empty($_POST["todays_adjective_input"])){
			$today_html = "<p>Tänane päev on " .$_POST["todays_adjective_input"] .".</p>";
			$todays_adjective = $_POST["todays_adjective_input"];
		} else {
			$today_adjective_error = "Palun kirjutage tänase kohta omadussõna!";
		}
	}
	
	//lisan lehele juhusliku foto
	$photo_dir = "../photos/";
	$all_files = array_slice(scandir($photo_dir), 2);
	
	//kontrollin ja võtan ainult fotod
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$all_photos = [];
	foreach($all_files as $file){
		$file_info = getimagesize($photo_dir .$file);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($all_photos, $file);
			}//if in_array lõppeb
		}//if isset lõppeb
	}//foreach lõppeb
	
	$file_count = count($all_photos);
	$photo_num = mt_rand(0, $file_count - 1);
    
    if(isset($_POST["photo_select_submit"])){
		$photo_num = $_POST["photo_select"];
	}
    
	$photo_html = '<img src="' .$photo_dir .$all_photos[$photo_num] .'" alt="Tallinna Ülikool">';
	$photo_file_html = "\n <p>".$all_photos[$photo_num] ."</p> \n";
    
    $photo_list_html = "\n <ul> \n";
	
	//tsükkel
	//for($i=algväärtus; $i < piirväärtus; $i muutumine){...}
	
	//<ul>
	//<li>pildifail1.jpg</li>
	//...
	//<li>pildifailn.jpg</li>
	//</ul>
	
	for($i = 0; $i < $file_count; $i ++){
		$photo_list_html .= "<li>" .$all_photos[$i] ."</li> \n";
	}
	$photo_list_html .= "</ul> \n";
	
/* 	<select name="photo_select">
		<option value="0">tlu_astra_600x400_1.jpg</option> 
		<option value="1">tlu_astra_600x400_2.jpg</option> 
		<option value="2">tlu_hoov_600x400_1.jpg</option> 
		<option value="3">tlu_mare_600x400_1.jpg</option> 
		<option value="4">tlu_mare_600x400_2.jpg</option> 
		<option value="5">tlu_terra_600x400_1.jpg</option> 
		<option value="6">tlu_terra_600x400_2.jpg</option> 
		<option value="7">tlu_terra_600x400_3.jpg</option> 
	</select>  */
	
	$photo_select_html = '<select name="photo_select">' ."\n";
	for($i = 0; $i < $file_count; $i ++){
		$photo_select_html .= '<option value="' .$i .'"';
        if($i == $photo_num){
			$photo_select_html .= " selected";
		}
        $photo_select_html .= '>' .$all_photos[$i] ."</option> \n";
	}
	$photo_select_html .= "</select> \n";
	
    $email = null;
	$email_error = null;
	$password_error = null;
	$notice = null;
    //sisselogimine
    if(isset($_POST["login_submit"])){
		if(isset($_POST["email_input"]) and !empty($_POST["email_input"])){
			$email = filter_var($_POST["email_input"], FILTER_VALIDATE_EMAIL);
			if(strlen($email) < 5){
				$email_error = "Palun sisesta kasutajatunnus (e-mail)!";
			}
		} else {
			$email_error = "Palun sisesta kasutajatunnus (e-mail)!";
		}
		if(isset($_POST["password_input"]) and !empty($_POST["password_input"])){
			if(strlen($_POST["password_input"]) < 8){
				$password_error = "Sisestatud salasõna on liiga lühike!";
			}
		} else {
			$password_error = "Palun sisesta salasõna!";
		}
		if(empty($email_error) and empty($password_error)){
			$notice = sign_in($email, $_POST["password_input"]);
		} else {
			$notice = $email_error ." " .$password_error;
		}
    }
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<p>Õppetöö toimus 2021 sügisel.</p>
	<hr>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="email" name="email_input" placeholder="email ehk kasutajatunnus" value="<?php echo $email; ?>">
        <input type="password" name="password_input" placeholder="salasõna">
        <input type="submit" name="login_submit" value="Logi sisse">
		<span><?php echo $notice; ?></span>
    </form>
    <p>Loo endale <a href="add_user.php">kasutaja</a>!</p>
    <hr>
	<!--ekraanivorm-->
	<form method="POST">
		<input type="text" name="todays_adjective_input" placeholder="tänase päeva ilma omadus" value="<?php echo $todays_adjective; ?>">
		<input type="submit" name="submit_todays_adjective" value="Saada ära">
		<span><?php echo $today_adjective_error; ?></span>
	</form>
	<?php echo $today_html; ?>
	<hr>
    <?php echo show_latest_public_foto(); ?>
    <hr>
	
	<form method="POST">
		<?php echo $photo_select_html; ?>
        <input type="submit" name="photo_select_submit" value="Näita valitud fotot">
	</form>
	
	<?php
		echo $photo_html;
        echo $photo_file_html;
		echo "<hr> \n";
		echo $photo_list_html;
	?>
</body>
</html>
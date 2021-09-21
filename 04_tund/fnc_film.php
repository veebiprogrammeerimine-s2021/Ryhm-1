<?php
    $database = "if21_inga_pe_E1";
    
    function read_all_films(){
        //var_dump($GLOBALS);
        //loome andmebaasiühenduse  mysqli  |  server, kasutaja, parool, andmebaas
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        //määrame vajaliku kodeeringu
        $conn->set_charset("utf8");
        //valmistan ette SQL päringu: SELECT * FROM film
        $stmt = $conn->prepare("SELECT * FROM film");
        echo $conn->error;
        //seon tulemused muutujatega
        $stmt->bind_result($title_from_db, $year_from_db, $duration_from_db, $genre_from_db, $studio_from_db, $director_from_db);
        //täidan käsu
        $film_html = null;
        $stmt->execute();
        //võtan kirjeid kuni jätkub
        while($stmt->fetch()){
            //<h3>Filmi nimi</h3>
            //<ul>
            //<li>Valmimisaasta: 1976</li>
            //<li>...
            //</ul>
            $film_html .= "\n <h3>" .$title_from_db ."</h3> \n";
            $film_html .= "<ul> \n";
            $film_html .= "<li>Valmimisaasta: " .$year_from_db ."</li> \n";
            $film_html .= "<li>Kestus: " .$duration_from_db ."</li> \n";
            $film_html .= "<li>Žanr: " .$genre_from_db ."</li> \n";
            $film_html .= "<li>Tootja: " .$studio_from_db ."</li> \n";
            $film_html .= "<li>Lavastaja: " .$director_from_db ."</li> \n";
            $film_html .= "</ul> \n";
        }
        //sulgen käsu
        $stmt->close();
        //sulgeme andmebaasiühenduse
        $conn->close();
        return $film_html;
    }
    
    function store_film($title_input, $year_input, $duration_input, $genre_input, $studio_input, $director_input){
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $conn->set_charset("utf8");
        //SQL: INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES("Suvi", 1976, 83, "Tallinnfilm", "Arvo Kruusement")
        $stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
        echo $conn->error;
        //seome SQL käsuga päris andmed
        //i - integer, d - decimal, s - string
        $stmt->bind_param("siisss", $title_input, $year_input, $duration_input, $genre_input, $studio_input, $director_input);
        //käsu täitmine
        $success = null;
        if($stmt->execute()){
            $success = "Salvestamine õnnestus!";
        } else {
            $success = "Salvestamisel tekkis viga: " .$stmt->error;
        }
        
        $stmt->close();
        $conn->close();
        return $success;
    }
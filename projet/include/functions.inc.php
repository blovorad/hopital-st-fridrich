<?php

    /*Cette fonction permet d'extraire la ville ou se situe l'adresse ip*/
    function ExtractCityOfIpAdresse(string $ip): string{
        $fluxXml = fopen("http://www.geoplugin.net/xml.gp?ip=".$ip, "r");
        $found = 1;
            
        while($found == 1 && ($lineOfFluxXml = fgets($fluxXml)) !== false){
            if(strpos($lineOfFluxXml, "geoplugin_city") !== false){
                $lineOfFluxXml = str_replace("<geoplugin_city>", "", $lineOfFluxXml);
                $lineOfFluxXml = str_replace("</geoplugin_city>", "", $lineOfFluxXml);
                $found = 0;
            }
        }

        fclose($fluxXml);
            
        return $lineOfFluxXml;
    }

    /*Cette fonction permet de récupérer l'adresse ip de l'utilisateur*/
    function getIpAdresseOfUser(): string{
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
    /*Cette fonction nous connecte à la base de donnée postgres*/
    function connectToDatabase(): bool{

        $host = '10.40.128.23';
        $port = '5432';
        $dbname = 'db21l3i_glevesqu';
        $username = 'y21l3i_glevesqu';
        $password = 'A123456*';
    
        $dsn = "host=$host port=$port dbname=$dbname user=$username password=$password";
        
        $conn = pg_connect($dsn);
            
        if($conn == false){

            return false;
        }
        else{
            
            $_POST['connection'] = $conn;
            //echo "Connecté à $dbname avec succès!";
            return true;
        }
    }   

    /*Cette fonction verifie si le mot de passe et l'identifiant existe dans la base de donnée*/
    function checkIdentifiant(string $identifiant, string $mot_de_passe): bool{

        $tryconnection = connectToDatabase();
        if($tryconnection == false){

            return false;
        }

        $conn = $_POST['connection'];

        $identifiant = htmlspecialchars($identifiant);
        $password = htmlspecialchars($mot_de_passe);

        $crytedPassword = crypt($mot_de_passe, '$5$rounds=5000$celacgelercacheu$');

        $result = pg_prepare($conn, 'identPassQuery', 'SELECT * FROM identifiant_web WHERE identifiant = $1 and mot_de_passe = $2');
        $result = pg_execute($conn, 'identPassQuery', array($identifiant, $crytedPassword));

        pg_close($conn);
        $connectionInfoDatabase = pg_fetch_array($result);

        if($result == false || $connectionInfoDatabase == false){
            
            return false;
        }

        if($connectionInfoDatabase['identifiant'] == $identifiant && $connectionInfoDatabase['mot_de_passe'] == $crytedPassword){

            return true;
        }

        return false;
    }

    /*recupère l'ensemble des informations d'un utilisateur*/
    function getInformationAboutUser(string $identifiant, string $mot_de_passe): array{

        $tryconnection = connectToDatabase();
        if($tryconnection == false){

            return false;
        }

        $conn = $_POST['connection'];

        $result = pg_prepare($conn, 'getInfo', 'SELECT * FROM personnel WHERE id_personnel = $1');
        $result = pg_execute($conn, 'getInfo', array($identifiant));

        pg_close($conn);
        $infoPersonnel = pg_fetch_array($result);

        return $infoPersonnel;
    }

    /*recupère le role d'un utilisateur*/
    function getRoleOfUser(string $identifiant, string $mot_de_passe): string{

        $tryconnection = connectToDatabase();
        if($tryconnection == false){

            return false;
        }

        $conn = $_POST['connection'];

        $result = pg_prepare($conn, 'getInfo', 'SELECT specialite FROM soignant WHERE id_personnel = $1');
        $result = pg_execute($conn, 'getInfo', array($identifiant));

        pg_close($conn);
        $infoPersonnel = pg_fetch_array($result);

        if($infoPersonnel == NULL){

            return "Administration";
        }

        return $infoPersonnel['specialite'];
    }

    /*recupere un planning*/ 
    function getPlanning(string $identifiant, string $mois, string $annee){

        $tryconnection = connectToDatabase();
        if($tryconnection == false){

            return false;
        }

        $conn = $_POST['connection'];

        $date1 = "".$annee."-".$mois."-01";
        $date2 = "".$annee."-".$mois."-31";

        if($mois == '09' || $mois == '11' || $mois == '04' || $mois == '06'){

            $date2 = "".$annee."-".$mois."-30";
        }
        else if($mois == '02'){

            $date2 = "".$annee."-".$mois."-28";
        }

        $result = pg_prepare($conn, 'getPlanning', 'SELECT date,heure FROM creneau WHERE id_personnel = $1 AND date >= $2 AND date <= $3');
        $result = pg_execute($conn, 'getPlanning', array($identifiant, $date1, $date2));

        pg_close($conn);

        return $result;
    }

    function getConsultationIdPatient(string $identifiant, string $date){

        $tryconnection = connectToDatabase();
        if($tryconnection == false){

            return false;
        }

        $conn = $_POST['connection'];

        $result = pg_prepare($conn, 'getConsultation', 'SELECT id_patient FROM consultation NATURAL JOIN creneau WHERE id_personnel = $1 AND date = $2');
        $result = pg_execute($conn, 'getConsultation', array($identifiant, $date));

        pg_close($conn);

        return $result;
    }
    
    /*recupère le nom du service d'un utilisateur*/
    function getServiceOfUser(string $identifiant, string $mot_de_passe): string{

        $tryconnection = connectToDatabase();
        if($tryconnection == false){

            return false;
        }

        $conn = $_POST['connection'];

        $result = pg_prepare($conn, 'getInfo', 'SELECT id_service FROM soignant WHERE id_personnel = $1');
        $result = pg_execute($conn, 'getInfo', array($identifiant));

        $infoPersonnel = pg_fetch_array($result);

        if($infoPersonnel == NULL){

            return "administration";
        }

        $result = pg_prepare($conn, 'getInfoService', 'SELECT nom FROM service WHERE id_service = $1');
        $result = pg_execute($conn, 'getInfoService', array($infoPersonnel['id_service']));

        pg_close($conn);
        $infoService = pg_fetch_array($result);
        return  $infoService['nom'];
    }

    /*mise a jour du mail*/
    function updateMail(string $identifiant, string $mot_de_passe, string $mail){

        $tryconnection = connectToDatabase();
        if($tryconnection == false){

            return false;
        }

        $conn = $_POST['connection'];

        $result = pg_prepare($conn, 'updateMail', 'UPDATE personnel SET mail = $1 WHERE id_personnel = $2');
        $result = pg_execute($conn, 'updateMail', array($mail, $identifiant));

        pg_close($conn);
    }

    /*mise a jour du telephone*/
    function updatePhone(string $identifiant, string $mot_de_passe, string $phone){

        $tryconnection = connectToDatabase();
        if($tryconnection == false){

            return false;
        }

        $conn = $_POST['connection'];

        $result = pg_prepare($conn, 'updatePhone', 'UPDATE personnel SET telephone = $1 WHERE id_personnel = $2');
        $result = pg_execute($conn, 'updatePhone', array($phone, $identifiant));

        pg_close($conn);
    }

    /*regarde si le mail est bon*/
    function checkMailChange(string $mail): int{
            
        /*if(str_contains($mail, '-') || str_contains($mail, '%') || str_contains($mail, ';') || str_contains($mail, ')')
            || str_contains($mail, '(') || str_contains($mail, '\\') || str_contains($mail, '/') || str_contains($mail, '=')){

            return 1;
        }
        else if(!str_ends_with($mail, '.fr') && !str_ends_with($mail, '.com')){

            return 1;
        }
        else if(!str_contains($mail, '@')){

            return 1;
        }*/
        
        $result = htmlspecialchars($mail);
        $result = filter_var($mail, FILTER_VALIDATE_EMAIL);
        if($result == false){

            return 1;
        }
        return 2;
    }

    /*regarde si le telephone est bon*/
    function checkTelephoneChange(string $numero): int{

        $numero = htmlspecialchars($numero);
        if(strlen($numero) != 10){

            return 1;
        }

        $exit = false;
        $i = 0;
        while($i<strlen($numero)){

            $caract = $numero[$i];
            if($caract != '0' && $caract != '1' && $caract != '2' && $caract != '3' && $caract != '4' && $caract != '5'
              && $caract != '6' && $caract != '7' && $caract != '8' && $caract != '9'){
                
                
                $exit = true;
            }
            $i++;
        }
        if($exit == true){
            
            return 1;
        }

        return 2;
    }
?>
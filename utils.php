<?php
    function redirect($to) {
        header("Location: " . $to);
        exit();
    }

    function includeFile($file, $variables) {
        include($file);
    }

    function isLog(){
        return (isset($_SESSION['logged'])) && ($_SESSION['logged'] == "yes");
    }
     
    function checkCredentials() {
        if(!isLog()){                   
            redirect("logout.php");
        }
    }
    
    function logIn($username) {
        $_SESSION['user'] = $username; 
        $_SESSION['logged'] = "yes"; 
        redirect("home.php");
    }
    
    function logOut() {
        session_destroy();
        unset($_SESSION['user']);
        unset($_SESSION['logged']);

        redirect("index.php");
    }
     
    function directoryName($username) {
        return $username . '_user';
    }
    
    function passFile($username) {
        return $username . '_pass.txt';
    }
    
    function setUserDirectory($username, $pass) {
        $directoryName = directoryName($username);
        $ourFile = $directoryName ."/". passFile($username);

        if (!file_exists($directoryName)) {
            mkdir($directoryName, 0777, true);
            $ourFileHandle = fopen($ourFile, 'w') or die("can't open file");
            fclose($ourFileHandle);

            $fopen = fopen($ourFile, 'a');
            fwrite($fopen, $pass);

            fclose($fopen);
            redirect("index.php");
        }else{
            return "Username already in use... Try other";
        }
    }
    
    function checkLogIn($username, $pass) {
        $directoryName = directoryName($username);
        $myfile = $directoryName ."/". passFile($username);
        $exists = file_exists($myfile); 

        if($exists){ 
            $file = $myfile; 
            $fh = fopen($file, 'r'); 
            $fpass = fread($fh, filesize($file)); 
            fclose($fh);
        } 

        if(($exists) and ($pass == $fpass)){ 
            logIn($username);
        }else{ 
            return "Username or password was incorrect."; 
        } 
    } 
    
    function find_string_in_array ($arr, $string) {
        return array_filter($arr, function($value) use ($string) {
            return strpos($value, $string) !== false;
        });
    }

    /*$arr = ['orange',
         'green string',
         'green', 
         'red', 
         'black'];

    $results = find_string_in_array ($arr, 'green');

    if( empty($results) ) { echo 'No matches found.'; }
    else { echo "'green' was found in: " . var_dump($results); }*/
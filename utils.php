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
            redirect("index.php");
        }
    }
    
    function getUserName() {
        return $_SESSION['user'];
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
        return $username . '_user/';
    }
    
    function passFile($username) {
        $directoryName = directoryName($username);
        return $directoryName . $username . '_pass.txt';
    }
    
    function indexFile($username) {
        $directoryName = directoryName($username);
        return $directoryName ."index.txt";
    }
    
    function contentFile($username) {
        $directoryName = directoryName($username);
        return $directoryName ."content.txt";
    }
    
    function shareIndexFile($username) {
        $directoryName = directoryName($username);
        return $directoryName ."share_index.txt";
    }
    
    function shareContentFile($username) {
        $directoryName = directoryName($username);
        return $directoryName ."share_content.txt";
    }
    
    function setUserDirectory($username, $pass) {
        $directoryName = directoryName($username);
        $passFile = passFile($username);
        $indexFile = indexFile($username);
        $contentFile = contentFile($username);
        $shareContentFile = shareContentFile($username);
        $shareIndexFile = shareIndexFile($username);

        if (!file_exists($directoryName)) {
            mkdir($directoryName, 0777, true);

            $passFileHandle = fopen($passFile, 'w') or die("can't open file");
            fclose($passFileHandle);
            
            $indexFileHandle = fopen($indexFile, 'w') or die("can't open file");
            fclose($indexFileHandle);
            
            $contentFileHandle = fopen($contentFile, 'w') or die("can't open file");
            fclose($contentFileHandle);
            
            $shareIndexFileHandle = fopen($shareIndexFile, 'w') or die("can't open file");
            fclose($shareIndexFileHandle);
            
            $shareContentFileHandle = fopen($shareContentFile, 'w') or die("can't open file");
            fclose($shareContentFileHandle);

            $fopen = fopen($passFile, 'a');
            fwrite($fopen, $pass);

            fclose($fopen);
            redirect("index.php");
        }else{
            return "Username already in use... Try other";
        }
    }
    
    function checkLogIn($username, $pass) {
        $directoryName = directoryName($username);
        $myfile = passFile($username);
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
        return array_filter($arr,  function($value) use ($string) {
            return strpos($value, $string) !== false;
        });
    }

    function getUsers($username){
        $path = "./";
        $files = array_diff(scandir($path), array('.', '..', $username."_user"));
        $files = find_string_in_array($files, 'user');
        return array_map(function($user) {
            return str_replace("_user", "", $user);
        }, $files);
    }
    
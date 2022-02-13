<?php
//Start session
    session_start();
    include("main.html");
    include('resources/database.php');
    include('resources/history.php');
/*
//List recently listened - name, listened to at
    
        $cd = curl_init();
        $url = 'https://api.spotify.com/v1/me/player/recently-played?limit=50';
        curl_setopt($cd, CURLOPT_URL, $url);
        $headerr[]= 'Authorization: Bearer '.$_SESSION['token'];
        curl_setopt($cd, CURLOPT_HTTPHEADER, $headerr);
        curl_setopt($cd, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cd);
        $answer = json_decode($response,true);
        for($i = 0; $i < count($answer['items']); $i++)
        {
            echo $answer['items'][$i]['track']['name'].' : ';
            echo $answer['items'][$i]['played_at'].'<br>';
        }
*/    
//Add recently listened to to db
    getHistory($_SESSION['current_user_id']);
?>


<?php
//Start session
    session_start();
//include
    include('resources/database.php');
//Get 'code' from callback query
    $code = $_GET['code'];
    $client_id = $_SESSION['client_id'];
    $client_secret = $_SESSION['client_secret'];
//POST request - use 'code' to get access token
    $ch = curl_init();
    $url = 'https://accounts.spotify.com/api/token?grant_type=authorization_code&code='.$code.'&redirect_uri=http%3A%2F%2F'.$_SESSION['ip'].'%2Fcallback.php';
    curl_setopt($ch, CURLOPT_URL, $url);
    $temp = '4666c3f6d93f44578ccfd877c3aae055:17d89c56b1b447e2bf45f2de7433d965';
    $auth_code = base64_encode($temp);
    $header[]= 'Authorization: Basic '.$auth_code;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
//get response body
    $body = substr($response, $header_size);
    $body = json_decode($response, true);
    curl_close($ch);
//PUT request to the Spotify API - get user data - if new user insert it into table
    $cd = curl_init();
    $url = 'https://api.spotify.com/v1/me';
    curl_setopt($cd, CURLOPT_URL, $url);
    $_SESSION['token'] = $body['access_token'];
    $headerr[]= 'Authorization: Bearer '.$body['access_token'];
    curl_setopt($cd, CURLOPT_HTTPHEADER, $headerr);
    curl_setopt($cd, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($cd);
    $answer = json_decode($response,true);
    $_SESSION['current_user_id'] = $answer['id'];
//Register user tokens
    addTokens($answer['id'],$body['access_token'],$body['refresh_token']);
//check if user is new
    $users = getAllUserId();
    $already = 0;
    for($i = 0; $i < count($users); $i++)
    {
        if($users[$i]['user_id'] == $answer['id'])
        {
            $already = 1;
        }
    }
    if(!$already)
    {
        $ans = addUser($answer['display_name'],$answer['email'],$answer['id']);
        $ans ? 'done' : 'error';
    }
//redirect
    header("Location: main.php"); 
    exit();
?>
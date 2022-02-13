<?php
//Start session
    session_start();
//Get history
function getHistory($user_id)
{   
        $sql = 'SELECT auth_token FROM tokens WHERE `user_id` = "'.$user_id.'"';
        $ans = sqlSelect($sql);
        $auth = $ans[0]['auth_token'];
        $cd = curl_init();
        $url = 'https://api.spotify.com/v1/me/player/recently-played?limit=50';
        curl_setopt($cd, CURLOPT_URL, $url);
        $headerr[]= 'Authorization: Bearer '.$auth;
        curl_setopt($cd, CURLOPT_HTTPHEADER, $headerr);
        curl_setopt($cd, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cd);
        $response_code = curl_getinfo($cd, CURLINFO_RESPONSE_CODE);
        curl_close($cd);
    //Expired auth token handle
        if($response_code == '401')
        {
            refreshAccess($user_id);
            getHistory($user_id);
            return 0;
        }
        $answer = json_decode($response,true);
        for($j = count($answer['items'])-1; $j >= 0; $j--)
        {
        //anti-duplication
                $sql = 'SELECT `played_at` FROM history WHERE `played_at` = "'.$answer['items'][$j]['played_at'].'" AND `user_id` = "'.$user_id.'"';
                $ans = sqlSelect($sql);
                if(count($ans) != 0)
                {
                    continue;
                }
            //add song to history log
                $userId = $user_id;
                $trackId = $answer['items'][$j]['track']['id'];
                $trackName = $answer['items'][$j]['track']['name'];
                $artistName = '';
                for($k = 0; $k < count($answer['items'][$j]['track']['artists']); $k++)
                {
                    if($k)
                    {
                        $artistName .= ', ';
                    }
                    $artistName .= $answer['items'][$j]['track']['artists'][$k]['name'];
                }
                $playedAt = $answer['items'][$j]['played_at'];
                $context = $answer['items'][$j]['context']['uri'];
                $sql = 'INSERT INTO history (`user_id`, `track_id`, `artist_name`, `track_name`, `played_at`, `context`) 
                VALUES ("'.$userId.'","'.$trackId.'","'.$artistName.'","'.$trackName.'","'.$playedAt.'","'.$context.'")';
                sqlInsert($sql);
            }
    }
   
//Refresh access token
    function refreshAccess($userId)
    {
        
        $sql = 'SELECT `refresh_token` FROM tokens WHERE `user_id` = "'.$userId.'"';
        $refreshToken = sqlSelect($sql)[0]['refresh_token'];
        $ch = curl_init();
        $url = 'https://accounts.spotify.com/api/token?grant_type=refresh_token&refresh_token='.$refreshToken;
        curl_setopt($ch, CURLOPT_URL, $url);
        $auther = $_SESSION['client_id'].":".$_SESSION['client_secret'];
        $auth_code = base64_encode($auther);
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
        $newAccess = $body['access_token'];
        $sql = 'UPDATE `tokens` SET `auth_token` = "'.$newAccess.'" WHERE `user_id` = "'.$userId.'"';
        sqlInsert($sql);
        curl_close($ch);
    }
?>
<?php
//Start session
    session_start();
//Redirect to Spotify login page
    header("Location: https://accounts.spotify.com/authorize?client_id=".$_SESSION['client_id']."&response_type=code&redirect_uri=http%3A%2F%2F".$_SESSION['ip']."%2Fcallback.php&scope=user-read-playback-state%20user-read-private%20user-read-recently-played%20user-read-email&state=34fFs29kd09");
    exit();
?>
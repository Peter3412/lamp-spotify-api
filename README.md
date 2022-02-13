# lamp-spotify-api
A LAMP stack spotify API project to auto-save users listening history

Hey guys!

Here you can find a basic application to authenticate users through the Spotify API, then using the access tokens and refresh tokens a script, which should auto-run every now-and-then (cron) collects all the authenticated users listening history and stores it in a database alongside the registered users and there access and refresh tokens, also automaticly acquires new access tokens when they expire, using the refresh tokens. What it really is is a foundation, on which feel free to build your own ideas. | Maybe if you're having problem implementing OAuth yourself, or working with databases with PHP take a peek.

Requirments:
  WebServer
    You need to host it, can't just run it on back-end, cause of the initial Spotify user authentication process
  PHP
  MySQL
    Also you have to set-up the databases that the scripts require, to do so just run resources/dbScript.sql
  Cron
    To automate the script that updates the history list
    
Set-up:
  At your Spotify Dashboard whitlist http://<your_url>/callback.php
  
  resources/database.php
    Fill-out database credentials
    
  resources/dbScript.sql
    Script to build needed databases in MySQL
    
  services/history.php
    Fill-out database credentials
    In the refreshAccess function put-in your Spotify provided client_id and client_secret
    Once there are authenticated users running this script updates the listening history of all the users, so auto-run it like every half hour or so...
    
  index.php
    Fill-out your client_id, client_secret and your ip/hosting address

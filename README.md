# lamp-spotify-api
<h1>A LAMP stack spotify API project to auto-save users listening history</h1>
<p>
Here you can find a basic application to authenticate users through the Spotify API, then using the access tokens and refresh tokens a script, which should auto-run every now-and-then (cron) collects all the authenticated users listening history and stores it in a database alongside the registered users and there access and refresh tokens, also automaticly acquires new access tokens when they expire, using the refresh tokens. What it really is is a foundation, on which feel free to build your own ideas. | Maybe if you're having problem implementing OAuth yourself, or working with databases with PHP take a peek.
</p>
<h2>Requirments:</h2>
<ul><li><h3>WebServer</h3>You need to host it, can't just run it on back-end, cause of the initial Spotify user authentication process</li>
<li><h3>PHP</h3></li>
<li><h3>MySQL</h3>Also you have to set-up the databases that the scripts require, to do so just run resources/dbScript.sql</li>
<li><h3>Cron</h3>To automate the script that updates the history list</li></ul>
<h2>Set-up:</h2>
<ul><li>At your Spotify Dashboard whitlist http://<your_url>/callback.php</li>
<li><h3>resources/database.php</h3>Fill-out database credentials</li>
<li><h3>resources/dbScript.sql</h3>Script to build needed databases in MySQL</li>
<li><h3>resources/history.php</h3>Fill-out database credentialsIn the refreshAccess function put-in your Spotify provided client_id and client_secretOnce there are authenticated users running this script updates the listening history of all the users, so auto-run it like every half hour or so...</li>
  <li><h3>index.php</h3>Fill-out your client_id, client_secret and your ip/hosting address</li></ul>

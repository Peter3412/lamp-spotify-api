<?php
//Start session
    session_start();
//Database setup
    class database
    {
        private $host = ''; // FILL OUT
        private $user = ''; // FILL OUT
        private $password = ''; // FILL OUT
        private $db = TRUE;

        public function dbStart()
        {
        // Create connection
            $this->db = new mysqli($this->host, $this->user, $this->password);
        
        // Check connection
            if(!$this->db) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }
        //Set charset and collation
            $this->db->select_db('hstrfy');
            $this->db->set_charset('utf8');
        }
        public function dbClose()
        {
        //Close database connection
            $this->db->close();
        }
        public function execute($sql)
        {
        
            $ans = $this->db->query($sql);
            if($ans === TRUE)
            {
                return TRUE;
            }
            $json = array();
            while ($row = $ans->fetch_assoc())
            {
                $json[] = $row;
            }
            return $json;
        }
    }
    function sqlInsert($sql)
    {
        $db1 = new database;
        $db1->dbStart();
        $ans = $db1->execute($sql);
        $db1->dbClose($db1);
        return $ans;

    }
    function sqlSelect($sql)
    {
        $db1 = new database;
        $db1->dbStart();
        $ans = $db1->execute($sql);
        $db1->dbClose($db1);
        return $ans;

    }
//Add new user to database;
    function addUser($userName,$userEmail,$userId)
    {
        $sql = 'INSERT INTO refresh (`user_id`) VALUES ("'.$userId.'")';
        sqlInsert($sql);
        $sql = 'INSERT INTO users (`user_name`,`user_email`,`user_id`) VALUES ("'.$userName.'","'.$userEmail.'","'.$userId.'")';
        $ans = sqlInsert($sql);
    }
//Get all user id
    function getAllUserId()
    {
        $sql = 'SELECT `user_id` FROM users';
        $ans = sqlSelect($sql);
        return $ans;
    }
//Register user tokens
    function addTokens($user_id,$authToken, $refreshToken)
    {
        $sql = 'SELECT `user_id` FROM tokens WHERE `user_id` = "'.$user_id.'"';
        $ans = sqlSelect($sql);
        if(count($ans) == 0)
        {
            $sql = 'INSERT INTO tokens (`user_id`, `auth_token`, `refresh_token`) VALUES("'.$user_id.'","'.$authToken.'","'.$refreshToken.'")';
            sqlInsert($sql);
        }
        else
        {
            $sql = 'UPDATE tokens (`auth_token`, `refresh_token`) SET `auth_token` = "'.$authToken.'", `refresh_token` = "'.$refreshToken.'" WHERE `user_id` = "'.$user_id.'"';
        }
    }
?> 
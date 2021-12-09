<?php

class db
{
    private $host = '127.0.0.1';
    private $user = 'root';
    private $password = 'root@123';
    private $database =  'clone_twitter';

    public function connection()
    {

        $connect = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        mysqli_set_charset($connect, 'utf8');

        if (mysqli_connect_errno()) {
            echo ("a conexão apresentou um problema: " . mysqli_connect_error());
        }
        return $connect;
    }
}

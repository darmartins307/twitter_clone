<?php




try {


    $con = new PDO("mysql:host=127.0.0.1", "root", "root@123");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo "error:" . $e->getMessage();
}

//Criando banco de dados caso não existir.
$query = "CREATE DATABASE IF NOT EXISTS clone_twitter";
$con->exec($query);

//Selecionando o banco de dados.
$query = "USE clone_twitter";
$con->exec($query);

//Criando a tabela users caso não exista.
$query = "CREATE TABLE IF NOT EXISTS users (id int primary key auto_increment not null, name varchar(55), email varchar(55), password varchar(100), pic varchar(55)); ";
$con->exec($query);

//Criando a tablea user_follow caso não exista.
$query = "CREATE TABLE IF NOT EXISTS user_follow(id int primary key auto_increment not null, id_user varchar(20), follow_id_user varchar(20));";
$con->exec($query);

//Criando a tablea tweet caso não exista.
$query = "CREATE TABLE IF NOT EXISTS tweet (id int primary key not null auto_increment, id_usuario varchar(20), tweet varchar(55));";
$con->exec($query);

//Inserindo o usuário 
$query = "INSERT INTO users(name, email, password) values ('admin', 'admin@admin.com.br', 'admin' )";
$con->exec($query);

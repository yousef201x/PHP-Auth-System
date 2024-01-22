<?php

const DB = 'xmedia';
const USERNAME = 'root';
const  PASSWORD = '';


function DBconnect()
{
    return $pdo = new PDO('mysql:host=localhost;dbname=' . DB, USERNAME, PASSWORD);
}

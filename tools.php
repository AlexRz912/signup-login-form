<?php

// Start session
session_start();

// Database configuration, change these according to your settings
const DB_TYPE = 'mysql';
const DB_HOST = 'localhost';
const DB_PORT = '3306';
const DB_NAME = 'tuto';
const DB_USER = 'root';
const DB_PASS = 'root';

$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Use types for parameters and return values of functions
// Increase code readability
function redirectTo(string $path): never
{
    header("{$_SERVER['SERVER_PROTOCOL']} 302 Found", true, 302);
    header("Location: {$path}");
    exit();
}

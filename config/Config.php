<?php
class Config {
    public static string $appName = 'Sistem Informasi Akademik';
    public static string $baseURL = 'http://localhost/mvc_uts_mahasiswa/';
    public static string $dbHost = 'localhost';
    public static string $dbName = 'db_akademik';
    public static string $dbUser = 'root';
    public static string $dbPass = '';

    public static function db(): PDO {
        return new PDO(
            'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName . ';charset=utf8mb4',
            self::$dbUser,
            self::$dbPass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }
}

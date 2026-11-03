
<?php

require_once __DIR__ . '/../config/Config.php';

class UserModel
{
    public function findByUsername(string $username): array|false
    {
        $db = Config::db();

        $sql = "SELECT id, nama, username, password_hash
                FROM users
                WHERE username = :username
                LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute(['username' => $username]);

        return $stmt->fetch();
    }
}

<?php
require_once __DIR__ . '/../config/Config.php';

class ProfileModel {
    public function getProfile(): array {
        return ['nama' => 'Administrator', 'pekerjaan' => 'Pengelola Sistem'];
    }
}

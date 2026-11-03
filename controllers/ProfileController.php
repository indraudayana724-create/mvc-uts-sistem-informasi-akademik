<?php
require_once __DIR__ . '/../models/ProfileModel.php';

class ProfileController {
    public function index(): void {
        $user = (new ProfileModel())->getProfile();
        require __DIR__ . '/../views/index.php';
    }

    public function about(): void {
        require __DIR__ . '/../views/aboutview.php';
    }
}

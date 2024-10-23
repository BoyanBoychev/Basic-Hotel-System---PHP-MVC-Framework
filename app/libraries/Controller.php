<?php

class Controller
{
    protected function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    protected function isAdmin()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['email'] === 'admin@admin.com';
    }
}

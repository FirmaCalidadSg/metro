<?php

function isLoggedIn() {
    session_start();
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_PATH . '/login');
        exit;
    }
}

function getCurrentUser() {
    return $_SESSION['username'] ?? null;
} 
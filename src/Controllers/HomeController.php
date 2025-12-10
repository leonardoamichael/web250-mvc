<?php
declare(strict_types=1);

namespace Web250\Mvc\Controllers;

class HomeController
{
    /**
     * Default landing page ("/" or "/home").
     */
    public function index(): string
    {
        // Start output buffering so we can return the rendered HTML as a string.
        ob_start();
        include __DIR__ . '/../Views/home.php';
        return ob_get_clean();
    }

    /**
     * About page ("/about") — optional, but already used in your lesson.
     */
    public function about(): string
    {
        ob_start();
        include __DIR__ . '/../Views/about.php';
        return ob_get_clean();
    }

    public function contact(): string
{
    ob_start();
    include __DIR__ . '/../Views/contact.php';
    return ob_get_clean();
}
}
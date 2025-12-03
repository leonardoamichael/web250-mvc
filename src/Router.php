<?php
// src/Router.php
//
// The Router's job is to:
// 1. Remember which URL paths map to which actions.
// 2. When a request comes in, figure out which action to run.
// 3. Call the appropriate action.
//
// It uses "callbacks" (functions) that are saved and run later.

class Router
{
    /**
     * @var array An array of routes, grouped by HTTP method (GET, POST, etc.).
     * Example:
     * [
     *   'GET' => [
     *     '/' => (callable),
     *     '/salamanders' => (callable),
     *   ]
     * ]
     */
    private array $routes = [];

    /**
     * Register a route that responds to HTTP GET requests.
     *
     * @param string   $path    The URL path (e.g. "/salamanders").
     * @param callable $handler A function to call when this path is requested.
     */
    public function get(string $path, callable $handler): void
    {
        // A "callback" is just a function we save for later.
        // We do NOT call it here; we simply remember it.
        $this->routes['GET'][$path] = $handler;
    }

    /**
     * Dispatch the current request:
     * - Check which path was requested.
     * - Look up the handler for that path.
     * - Run the handler (callback).
     *
     * @param string $uriPath The path part of the URL (e.g. "/salamanders").
     * @param string $method  The HTTP method (e.g. "GET").
     */
    public function dispatch(string $uriPath, string $method): void
    {
        // Remove trailing slash unless it is the root path.
        // Example: "/salamanders/" becomes "/salamanders".
        $path = rtrim($uriPath, '/');
        if ($path === '') {
            $path = '/';
        }

        // Do we have a handler for this method and path?
        if (isset($this->routes[$method][$path])) {
            // Yes. Get the callback.
            $handler = $this->routes[$method][$path];

            // Call the callback function.
            // This usually creates a controller and calls an action.
            $handler();
            return;
        }

        // If we get here, no route matched.
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
    }
}

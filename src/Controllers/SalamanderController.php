<?php
// src/Controllers/SalamanderController.php
//
// The Controller receives a request (from the router),
// asks the Model for data, and then chooses a View to display.

require_once __DIR__ . '/../Models/Salamander.php';

class SalamanderController
{
    /**
     * Controller action to show a list of all salamanders.
     */
    public function index(): void
    {
        // 1. Ask the model for all salamanders
        $salamanders = Salamander::all();

        // 2. Load the view and pass the data to it.
        // We do this by simply including the file. The view
        // can now use the $salamanders variable.
        require __DIR__ . '/../Views/Salamanders/index.php';
    }

    public function show(): void
{
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo "Bad Request: id is required.";
        return;
    }

    $id = (int) $_GET['id'];

    $salamander = Salamander::find($id);

    if ($salamander === null) {
        http_response_code(404);
        echo "Salamander not found.";
        return;
    }

    include __DIR__ . '/../Views/Salamanders/show.php';
}
}

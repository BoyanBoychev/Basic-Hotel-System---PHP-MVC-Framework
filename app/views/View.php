<?php

class View
{
    public static function render($view, $data = [])
    {
        // Extract data to variables
        extract($data);

        // Construct the path to the view file
        $viewFile = "../app/views/$view.php";

        // Debug output to see the rendering process
        //echo "Attempting to load view file: $viewFile<br>";

        if (file_exists($viewFile)) {
            //echo "View file found: $viewFile<br>"; // Debug message
            include "../app/views/layout.php"; // Include the layout
        } else {
            echo "View file not found: $viewFile<br>";
        }
    }
}

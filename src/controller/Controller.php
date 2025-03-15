<?php

class Controller {
    protected function render(string $template = null) {
        $templatePath = 'public/view/' . $template . '.html';
        $output = "File not found";


        if (file_exists($templatePath)) {
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}
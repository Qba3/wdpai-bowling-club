<?php

class Controller
{
    protected function render(string $template = null, array $messages = []): void
    {

        $templatePath = __DIR__ . '/../../public/view/' . $template . '.html';
        $output = "File not found";

        if (file_exists($templatePath)) {
            extract($messages);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}
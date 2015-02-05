<?php

class View
{
    private static $instance = null;
    private $template;
    private $viewData;

    private function prepareTemplate($template, $data)
    {
        $templateFile = __DIR__ . '/../src/templates/' . $template . '.php';

        if(!file_exists($templateFile)) {
            return "Error loading template file ($this->file).";
        }

        ob_start();
        include $templateFile;
        $content = ob_get_contents();
        ob_end_clean();

        foreach ($data as $key => $value) {
            $tagToReplace = "[@$key]";
            $content = str_replace($tagToReplace, $value, $content);
        }

        return $content;
    }

    public function render($template, $data = array())
    {
        //TODO check if data is correct
        /* if (is_array($data)) { */
        /*     extract($data); */
        /* } */
        /* include '../views/' . $template . '.php'; */

        $content = $this->prepareTemplate($template, $data);

        echo $this->prepareTemplate('layout', array('content' => $content));

    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new View();
        }
        return self::$instance;
    }
}

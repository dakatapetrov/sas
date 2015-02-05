<?php

class View
{
    private static $instance = null;
    private $template;
    private $viewData;

    private function prepareTemplate($template, $data)
    {
        $templateFile = __DIR__ . '/../src/templates/' . $template . '.tpl';

        if(!file_exists($templateFile)) {
            return "Error loading template file ($this->file).";
        }

        $content = file_get_contents($templateFile);

        foreach ($data as $key => $value) {
            $tagToReplace = "[@$key]";

            $content = str_replace($tagToReplace, $value, $content);
        }

        return $content;
    }

    public function render($template, $data = array())
    {
        $content = $this->prepareTemplate($template, $data);

        /* if (is_array($data)) { */
        /*     extract($data); */
        /* } */
        /* include '../views/' . $template . '.php'; */
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

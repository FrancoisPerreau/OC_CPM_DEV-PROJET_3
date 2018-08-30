<?php

namespace cyannlab\src\model;

class View
{
    // ATRIBUTS
    // =============================
    private $_file;
    private $_title;
    private $_pageName;


    // MÉTHODES
    // =============================
    public function renderFront($templateFront, $data = [])
    {
        $this->_file = '../views/frontviews/'.$templateFront.'.php';
        $content  = $this->renderFile($this->_file, $data);
        $view = $this->renderFile('../views/frontviews/frontbase.php', [
            'title' => $this->_title,
            'content' => $content
        ]);
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if(file_exists($file)){
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else {
            echo 'Fichier inexistant';
        }
    }

    // SETTERS ---------------------
    public function setTitle($title)
    {
        if(isset($title))
        {
            $this->_title = $title;
        }
    }


    // GETTERS ---------------------
    public function getPageTitle() { return $this->_title; }
    
}
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

    // Gestion des vues Front
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


    // Gestion des vues Back
    public function renderBack($templateFront, $data = [])
    {
        $this->_file = '../views/backviews/'.$templateFront.'.php';
        $content  = $this->renderFile($this->_file, $data);
        $view = $this->renderFile('../views/backviews/backbase.php', [
            'title' => $this->_title,
            'content' => $content
        ]);
        echo $view;
    }



    // Gestion de la vue Connexion
    public function renderConnexion($templateFront, $data = [])
    {
        $this->_file = '../views/connexionview/'.$templateFront.'.php';
        $content  = $this->renderFile($this->_file, $data);


        $view = $this->renderFile('../views/connexionview/connexionbase.php', [
            'title' => $this->_title,
            'content' => $content
        ]);
        
        echo $view;
    }


    // Inclusion des contenus des vues dans le template de base
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
<?php
namespace Controllers;
use Models\Article;

class ArticlesControllers{

    private static $globalTemplatePath = ROOT."/templates/global.php";

    public static function index(){
        self::getList();
    }

    public static function getList(){

        $articlesList = Article::getList();
        require_once ROOT."/views/articles_list.php";
        require_once self :: $globalTemplatePath;
    }

    public static function getById(int $id){
        $article = Article::getById($id);
        require_once ROOT."/views/show_articles.php";
        require_once self :: $globalTemplatePath;
    }

    public static function addArticle($title,$content,$author){
        Article::add($title,$content,author: $author); // Now $article holds the new Article object
        require_once ROOT."/views/writing_page.php";
        require_once self :: $globalTemplatePath;
    }

    public static function update(int $id){
        if ( mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post'){
            // var_dump($_POST);die;
            Article::updateArticle(
                $id, 
                $_POST['title'],
                $_POST['content'],
                $_POST['author'],
                (new \DateTime())->format('Y-m-d H:i:s')
            );
        }
        $article = Article::getById($id);

        require_once ROOT."/views/update_article.php";
        require_once self :: $globalTemplatePath;
    }

    
    
}
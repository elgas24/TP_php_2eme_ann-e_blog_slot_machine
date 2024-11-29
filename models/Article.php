<?php

namespace Models;

class Article
{

    // key words are : public, protected and private
    public static int $id;
    public static string $title;
    public static string $content;
    public static string $author;
    public static string|Datetime $created_date;
    public static string $modified_at;

    private static $bdd;
    public function __construct($bdd = null)
    {
        if (!is_null($bdd)) {
            self::setBdd($bdd);
        }
    }

    ////////////////////////////////////////////////////
    public static function getId()
    {
        return self::$id;
    }

    public static function setId(int $id)
    {
        self::$id = $id;
    }

    ////////////////////////////////////////////////////
    public static function getTitle()
    {
        return self::$title;
    }

    public static function setTitle(string $title)
    {
        self::$title = $title;
    }

    ////////////////////////////////////////////////////
    public static function getContent()
    {
        return self::$content;
    }

    public static function setContent(string $content)
    {
        self::$content = $content;
    }

    ////////////////////////////////////////////////////
    public static function getAuthor()
    {
        return self::$author;
    }

    public static function setAuthor(string $author)
    {
        self::$author = $author;
    }

    ////////////////////////////////////////////////////
    public static function getCreated_date()
    {
        $date = new \DateTime(self::$created_date);
        return $date;
    }

    public static function setCreated_date(string|\DateTime $created_date)
    {
        self::$created_date = $created_date;
    }

    ////////////////////////////////////////////////////
    public static function getModified_at()
    {
        $date = new \DateTime(self::$modified_at);
        return $date;
    }

    public static function setModified_at(string $modified_at)
    {
        self::$modified_at = $modified_at;
    }

    ////////////////////////////////////////////////////
    public static function add(
        string $title,
        string $content,
        string $author
    ) {
        try {
            $req = self::$bdd->prepare("INSERT INTO articles(title,content,author) VALUES (:title, :content, :author)");
            $req->bindValue(":title", $title, \PDO::PARAM_STR);
            $req->bindValue(":content", $content, \PDO::PARAM_STR);
            $req->bindValue(":author", $author, \PDO::PARAM_STR);

            if (!$req->execute()) {
                Utils::launchExeption("Une ereur s'est produite lors de l'ajout d'un article.");
            }

        } catch (\Exception $e) {
            Utils::readException($e);
        }
    }

    public static function getList()
    {
        try {
            $req = self::$bdd->prepare("SELECT * FROM articles ORDER BY id ASC");

            if (!$req->execute()) {
                Utils::launchExeption("une erreur s'est produite lors de la récupération de la liste des articles.");
            }
            $articles = $req->fetchAll(\PDO::FETCH_OBJ);
            $req->closeCursor();
            if (!$articles) {
                Utils::launchExeption("la table est vide.");
            }

            return $articles;
        } catch (\Exception $e) {
            Utils::readException($e);
        }
    }

    public static function getById(int $id)
    {
        try {
            $req = self::$bdd->prepare("SELECT * FROM articles WHERE id=:id");
            $req->bindValue(":id", $id, \PDO::PARAM_INT);
            if (!$req->execute()) {
                Utils::launchExeption("une erreur. est survenue lors de la réccupération de l'article.");
            }
            $article = $req->fetch(\PDO::FETCH_OBJ);
            if (!$article) {
                Utils::launchExeption("l'articles ciblé est introuvable");
            }
            self::setAllParams($article);
            return $article;
        } catch (\Exception $e) {
            Utils::readException($e);
        }
    }

    public static function updateArticle(
        int $id,
        string $title,
        string $content,
        string $author,
        string $created_at
    ) {
        try {
            $req = self::$bdd->prepare("UPDATE articles SET title=:title, content=:content, author=:author, created_date=:created_at WHERE id=:id");
            $req->bindValue(":id", $id, \PDO::PARAM_INT);
            $req->bindValue(":title", $title, \PDO::PARAM_STR);
            $req->bindValue(":content", $content, \PDO::PARAM_STR);
            $req->bindValue(":author", $author, \PDO::PARAM_STR);
            $req->bindValue(":created_at", $created_at, \PDO::PARAM_STR);

            if (!$req->execute()) {
                Utils::launchExeption("Une erreur s'est produite lors de la mise à jour de l'article.");
            }

            return true;
        } catch (\Exception $e) {
            Utils::readException($e);
        }
    }

    public static function deleteAll(int $id){
        return self::$bdd->exec("DELETE FROM articles");
    }

    public static function deleteArticle(int $id){
        return self::$bdd->exec("DELETE FROM articles WHERE iid=$id");
    }


    public static function setAllParams($params){
        [
            "id" => $id,
            "title" =>$title,
            "content" => $content,
            "author" => $author,
            "created_date" => $created_date,
            "modified_at" => $modified_at,
        ]= get_object_vars($params);
        self::setId($id);
        self::setTitle($title);
        self::setContent($content);
        self::setAuthor($author);
        self::setCreated_date($created_date);
        self::setModified_at($modified_at);

    }
    public static function setBdd($bdd)
    {
        self::$bdd = $bdd;
    }
}
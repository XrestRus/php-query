<?php

use classes\DBConnect;

require_once "../config.php";
require_once "../classes/DBConnect.php";

class CreateData {
    private array $comments;
    private array $posts;
    private mysqli $con;

    public function __invoke()
    {
        $this->load();
        $this->create();
        $this->log();
    }

    public function __construct()
    {
        $this->con = (new DBConnect())->getConnect();
    }

    /**
     * Загружает данные с сайта 'https://jsonplaceholder.typicode.com'
     */
    private function load() {
        $this->comments = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/comments"));
        $this->posts = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/posts"));
    }

    /**
     * Создает на основе загруженных данных записи в бд
     */
    private function create() {
        $this->addPosts();
        $this->addComments();
    }

    private function addPosts() {
        $query = $this->con->prepare("
            insert into post(`id`, `title`, `body`) 
            values(
                ?,
                ?,
                ?    
            )
        ");

        $query->bind_param('iss',
            $id,
            $title,
            $body
        );

        $id = null;
        $title = null;
        $body = null;

        foreach ($this->posts as $post) {
            $id = $post->id;
            $title = $post->title;
            $body = $post->body;

            $query->execute();
        }
    }

    private function addComments() {
        $query = $this->con->prepare("
            insert into comment(`id`, `name`, `email`, `body`, `postId`) 
            values(
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ");

        $query->bind_param('isssi',
            $id,
            $name,
            $email,
            $body,
            $postId
        );

        $id = null;
        $name = null;
        $email = null;
        $body = null;
        $postId = null;

        foreach ($this->comments as $comment) {
            $id = $comment->id;
            $name = $comment->name;
            $email = $comment->email;
            $body = $comment->body;
            $postId = $comment->postId;

            $query->execute();
        }
    }

    /**
     * Выводит в консоли подсчет
     */
    private function log() {
        $countPosts = $this->con
            ->query('select COUNT(id) from `post`')
            ->fetch_row()[0];
        $countComments = $this->con
            ->query('select COUNT(id) from `comment`')
            ->fetch_row()[0];

        print "Загружено $countPosts записей и $countComments комментариев";
    }
}

$c = new CreateData;
$c();

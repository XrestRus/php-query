<?php

use classes\DBConnect;

require_once "../config.php";
require_once "../classes/DBConnect.php";

class CreateData {
    public function __invoke()
    {
        $this->load();
        $this->create();
        $this->log();
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
        $con = (new DBConnect())->getConnect();

        foreach ($this->posts as $post) {
            $con->query("
                insert into post(`id`, `title`, `body`) 
                values(
                     $post->id,
                    '$post->title',
                    '$post->body'    
                )
            ");
        }
        foreach ($this->comments as $comment) {
            $con->query("
                insert into comment(`id`, `name`, `email`, `body`, `postId`) 
                values(
                     $comment->id,
                    '$comment->name',
                    '$comment->email',
                    '$comment->body',
                     $comment->postId
                )
            ");
        }
    }

    /**
     * Выводит в консоли подсчет
     */
    private function log() {
        $countPosts = count($this->posts);
        $countCommnets = count($this->comments);
        print "Загружено $countPosts записей и $countCommnets комментариев";
    }
}

$c = new CreateData;
$c();

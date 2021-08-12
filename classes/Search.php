<?php

namespace classes;

use classes\DBConnect;
use JetBrains\PhpStorm\Pure;
use mysqli;
use mysqli_result;

/**
 * Класс для поиска
 *
 * @method This->getPostsByWordToComments()
 */
class Search {
    private string $searchWord;
    private mysqli $con;

    /**
     * @param \classes\DBConnect $con
     * @param string $searchWord
     */
    #[Pure] public function __construct(DBConnect $con, string $searchWord) {
        $this->con = $con->getConnect();
        $this->searchWord = '%'.$searchWord.'%';
    }  

    /**
     * Метод возвращает посты, содержащие комментарии по поисковому слово
     * 
     * @return mysqli_result объект запроса(посты)
     */
    public function getPostsByWordToComments() : mysqli_result {
        $query = $this->con->prepare("
            select distinct `post`.`id`, `post`.`title`
                from `comment` 
                    JOIN `post` 
                        ON `comment`.`postId` = `post`.`id` 
            where `comment`.`body` LIKE ?    
        ");

        $query->bind_param('s', $this->searchWord);
        $query->execute();

        return $query->get_result();
    }

    /**
     * Метод возвращает комментарии, содержащие поисковое слово, к посту
     *
     * @param int $idPost id поста
     *
     * @return mysqli_result объект запроса(комментарии)
     */
    public function getCommentsToPost(int $idPost) : mysqli_result {
        $query = $this->con->prepare("
           select distinct `comment`.`body` 
                from `comment`
                    JOIN `post` 
                        ON `comment`.`postId` = ?
            where `comment`.`body` LIKE ?   
        ");

        $query->bind_param('is', $idPost, $this->searchWord);
        $query->execute();

        return $query->get_result();
    }
}
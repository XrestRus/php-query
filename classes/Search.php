<?php

namespace classes;

use classes\DBConnect;

/**
 * Класс для поиска
 * 
 * @method getPostsByWordToComments()
 * @method getCommentsToPost(int $idPost) 
 */
class Search {
    public function __construct(DBConnect $con, string $searchWord) {
        $this->con = $con->getConnect();
        $this->searchWord = $searchWord;
    }  

    /**
     * Метод возвращает посты, содержащие комментарии по поисковому слово
     * 
     * @return mysqli_result объект запроса(посты)
     */
    public function getPostsByWordToComments() {
        $resultSearch = $this->con->query("
            select distinct `post`.`id`, `post`.`title`
                from `comment` 
                    JOIN `post` 
                        ON `comment`.`postId` = `post`.`id` 
            where `comment`.`body` LIKE '%$this->searchWord%'    
        ");

        return $resultSearch;
    }

    /**
     * Метод возвращает комментарии, содержащие поисковое слово, к посту
     * 
     * @param int $idPost id поста
     * 
     * @return mysqli_result объект запроса(комментарии)
     */
    public function getCommentsToPost(int $idPost) {
        $comments = $this->con->query("
            select distinct `comment`.`body` 
                from `comment`
                    JOIN `post` 
                        ON `comment`.`postId` = $idPost    
            where `comment`.`body` LIKE '%$this->searchWord%'    
        ");

        return $comments;
    }
}
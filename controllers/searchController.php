<?php

namespace controllers;

use classes\DBConnect;
use classes\Search;

/**
 *  Класс контроллер для POST запроса на поиск
 * 
 *  @method This->Searcher($searchWord)
 */
class SearchController {
    /**
     * Метод создающий подключение и возвращающий объект поиска
     * 
     * @param string $searchWord поисковое слово
     * 
     * @return Search возвращает объект для поиска
     */
    public function Searcher(string $searchWord): Search
    {
        $dbConnect = new DBConnect();
        $searchWord = $searchWord ?? html_entity_decode($_POST['searchWord']);

        return new Search($dbConnect, $searchWord);
    }
}
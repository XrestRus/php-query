<?php

namespace classes;

/**
 * Класс для подключение к бд
 * 
 * @param string $host хостинг
 * @param string $user пользователь
 * @param string $pas пароль
 * @param string $db  название база данных 
 */
class DBConnect {
    /**
     * Свойство подключения
     */
    private $con;

    public function __construct(
        string $host = HOST, 
        string $user = USER, 
        string $pas = PAS, 
        string $db = DB
    ) {
        $this->con = new \mysqli($host, $user, $pas, $db);
        if (mysqli_connect_errno()) die("Неверное подключение");
    }

    /**
     * Метод ля получение подключения
     * 
     * @return mysqli возвращает подключение MySql
     */
    public function getConnect() {
        return $this->con;
    }
}

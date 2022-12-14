<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class GenreCollection
{
    /***
     * Recupère tous les genres que les séries peuvent avoir
     * @return array<Genre>
     */
    public static function findAllGenre():array{

        $genres = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,name
            FROM genre
SQL
);
        $genres->execute();
        return $genres->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\Genre");
    }
}
<?php

declare(strict_types=1);

namespace Entity\Collection;


use Database\MyPdo;
use PDO;

class TvShowCollection
{

    public static function findAll(): array
    {
        $bd = myPDO::getInstance()->prepare(
            <<<'SQL'
SELECT id,name,overview,posterId
FROM tvshow
ORDER BY name
SQL
        );
       $bd->execute();
       return $bd->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\TvShow");
    }


}
<?php

declare(strict_types=1);

namespace Entity\Collection;


use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use Entity\TvShow;
use PDO;

class TvShowCollection
{

    /**
     * Donne tous les tv show
     * @return array tableau avec tous les tv show
     */
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

    /**
     * Donne le tv show correspondant a l'id
     * @param int $id id du tv show
     * @return TvShow le tv show correspondant
     */
    public static function findByTvShowId(int $id) : TvShow
    {
        $Tvshow = MyPdo::getInstance()->prepare(
            <<<'SQL'
SELECT id, name, originalName, homepage, overview, posterId
FROM tvshow
WHERE id = :id
                
SQL
        );
        $Tvshow->execute(['id'=>$id]);

        if ($tvshowTab = $Tvshow->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\TvShow")) {
            return $tvshowTab[0];
        } else {
            throw new EntityNotFoundException();
        }
    }
}
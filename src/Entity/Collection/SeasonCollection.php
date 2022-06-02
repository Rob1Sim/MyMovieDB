<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;
use PDO;


class SeasonCollection
{

    /***
     * Recupère un tableau de saison par série
     * @param int $id id de la série
     * @return array<Season> Tableau de saison
     */
    public static function findByTvShowId(int $id):array{

        $seasons = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE tvShowId = :id
                
SQL
        );
        $seasons->execute(['id'=>$id]);

        return $seasons->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\Season");
    }

    /**
     * Donne la saison correspondant à l'id donné en paramètre
     * @param int $id id de la saison recherchée
     * @return Season saison correspondant à l'id
     */
    public static function findBySeasonId(int $id): Season{

        $seasons = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE id = :id
                
SQL
        );
        $seasons->execute(['id'=>$id]);

        return $seasons->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\Season")[0];
    }
}
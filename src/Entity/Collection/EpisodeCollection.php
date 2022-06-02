<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use PDO;

class EpisodeCollection
{
    /***
     * Recupère un tableau d'episode par saison
     * @param int $id id de la saison
     * @return array<Episode> Tableau d'episode
     */
    public static function findByEpisodeId(int $id):array
    {
        $episode = MyPdo::getInstance()->prepare(
            <<<'SQL'
SELECT id, seasonId, name, overview, episodeNumber
FROM episode
WHERE seasonId = :id           
SQL
        );
        $episode->execute(['id'=>$id]);
        return $episode->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\Episode");
    }
}

<?php
declare(strict_types=1);
namespace Entity\Collection;

use Database\MyPdo;
use Entity\Poster;
use PDO;


class PosterCollection
{
    /***
     * Recherche dans la base de données les poster celon l'id passé en paramètres
     * @param int $id L'id du poster
     * @return Poster Le string comportenant le poster
     */
    public static function findPosterById(int $id):Poster{
        $posters = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    SELECT id, jpeg
                    FROM album
                    WHERE id = :idPoster
                    
                SQL
        );

        $posters->execute(['idArt'=>$id]);

        $posterTab = $posters->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\Poster");

        return $posterTab[0];

    }
}
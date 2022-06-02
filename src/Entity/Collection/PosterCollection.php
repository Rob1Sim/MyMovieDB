<?php
declare(strict_types=1);
namespace Entity\Collection;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use Entity\Poster;
use PDO;


class PosterCollection
{
    /***
     * Recherche dans la base de données les posters selon l'id passé en paramètre
     * @param int $id L'id du poster
     * @return Poster Le string comportant le poster
     */
    public static function findPosterById(int $id):Poster{
        $posters = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    SELECT id, jpeg
                    FROM poster
                    WHERE id = :idPoster
                    
                SQL
        );

        $posters->execute(['idPoster'=>$id]);

        if ($posterTab = $posters->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\Poster")) {
            return $posterTab[0];
        } else {
            throw new EntityNotFoundException();
        }
    }
}
<?php
declare(strict_types=1);
namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use Entity\TvShow;
use PDO;
class TvShowGenreCollection
{
    /***
     * Recupère tous toutes les séries par un genre donnée
     * @param int $id Id du genre a recherché
     * @return array<TvShow>
     */
    public static function findTvShowByGenreId(int $id):array{

        $genres = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,genreid,tvshowid
            FROM tvshow_genre
            WHERE genreId = :idGenre
SQL
        );
        $genres->execute(['idGenre'=>$id]);
        $tvShowGenres = $genres->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\TvShowGenre");

        $tvShows = [];

        foreach ($tvShowGenres as $tsg){
            $tvShows[] = TvShowCollection::findByTvShowId($tsg->getgetTvShowId());
        }

        return $tvShows;
    }
}
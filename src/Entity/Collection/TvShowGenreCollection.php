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
     * Recupère toutes les séries par un genre donné
     * @param int $id Id du genre à rechercher
     * @return array<TvShow>
     */
    public static function findTvShowByGenreId(int $id):array{

        $genres = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,genreId,tvShowId
            FROM tvshow_genre
            WHERE genreId = :idGenre
SQL
        );
        $genres->execute(['idGenre'=>$id]);
        $tvShowGenres = $genres->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\TvShowGenre");

        $tvShows = [];

        foreach ($tvShowGenres as $tsg){
            $tvShows[] = TvShowCollection::findByTvShowId($tsg->getTvShowId());
        }

        return $tvShows;
    }
}
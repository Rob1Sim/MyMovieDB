<?php

declare(strict_types=1);

namespace Entity;

class TvShowGenre
{
    private int $id;
    private int $genreId;
    private int $tvShowId;

    /**
     * Getteur de l'id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getteur de l'id du genre
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * Getteur de l'id du tvshow
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }
}

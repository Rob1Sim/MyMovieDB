<?php

declare(strict_types=1);

use Entity\Collection\SeasonCollection;
use Entity\Collection\TvShowCollection;
use Entity\Exception\EntityNotFoundException;
use Html\WebPage;

$webPage = new WebPage();

$webPage->appendCssUrl('../css/style.css');

try {
    if (isset($_GET["showId"]) && ctype_digit($_GET["showId"])) {
        $show = TvShowCollection::findByTvShowId((int)$_GET["showId"]);
        $show->delete();
        header("Location: /");
    } elseif (isset($_GET["seasonId"]) && ctype_digit($_GET["seasonId"])) {
        $season = SeasonCollection::findBySeasonId((int)$_GET["seasonId"]);
        $season->delete();
        header("Location: /");
    } elseif (isset($_GET["epId"]) && ctype_digit($_GET["epId"])) {
        $season = \Entity\Collection\EpisodeCollection::findByEpisodeId((int)$_GET["epId"]);
        $season= $season[0];
        $season->delete();
        header("Location: /");

    } else{
        http_response_code(400);
    }
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

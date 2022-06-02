<?php
declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;

if (isset($_GET['episodeId']) && !empty(($_GET['episodeId'])) && ctype_digit($_GET['episodeId'])) {
    $seasonId = (int)$_GET['episodeId'];
} else {
    header("Location: /index.php ");
    exit;
}

try {
    $webPage = new AppWebPage();

    $season = Entity\Collection\SeasonCollection::findBySeasonId($seasonId);
    $string = AppWebPage::escapeString($season->getName());
    $res = Entity\Collection\TvShowCollection::findByTvShowId($season->getTvShowId());
    $string2 = AppWebPage::escapeString($res->getName());
    $webPage->setTitle("Serie TV : $string2 : $string");
    


} catch (EntityNotFoundException) {
    http_response_code(404);
}
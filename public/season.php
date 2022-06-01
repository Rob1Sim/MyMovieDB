<?php
declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;

if (isset($_GET['tvshowId']) && !empty(($_GET['tvshowId'])) && ctype_digit($_GET['tvshowId'])) {
    $tvshowId = (int)$_GET['tvshowId'];
} else {
    header("Location: /index.php ");
    exit;
}

try {
    $webPage = new AppWebPage();

    $tvshow = Entity\Collection\TvShowCollection::findByTvShowId($tvshowId);
    $string = AppWebPage::escapeString($tvshow->getName());
    $webPage->setTitle("Serie TV : $string");

    $webPage->appendContent("<div class=tvshow>");
    $webPage->appendContent("<div class='poster_serie'><img src='poster.php?posterId=".$tvshow->getPosterId()."' alt='poster de la série'></div>");
    $webPage->appendContent("<div class='nom_serie'>{$tvshow->getName()}</div>");
    $webPage->appendContent("<div class='nom_original_serie'>{$tvshow->getOriginalName()}</div>");
    $webPage->appendContent("<div class='overview_serie'>{$tvshow->getOverview()}</div></div>");


    $bd = Entity\Collection\SeasonCollection::findBySeasonId();

    foreach ($bd as $season) {
        $poster = $season->getPosterId();
        $name = AppWebPage::escapeString($season->getName());
        $webPage->appendContent(
            <<<HTML
                <div class='season'>
                    <div class="poster_serie"><img src="poster.php?posterId={$season->getPosterId()}" alt='poster de la série'></div>
                    <h3 class='season_name'>{$name}</h3>
                </div>

HTML
        );
    }

    echo $webPage->toHTML();
} catch (EntityNotFoundException) {
    http_response_code(404);
}

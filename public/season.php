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
    $webPage->appendContent("<h3 class='nom_serie'>{$tvshow->getName()}</h3>");
    $webPage->appendContent("<h4 class='nom_original_serie'>{$tvshow->getOriginalName()}</h4>");
    $webPage->appendContent("<p class='overview_serie'>{$tvshow->getOverview()}</p></div>");


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

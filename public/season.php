<?php
declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;

if (isset($_GET['seasonId']) && !empty(($_GET['seasonId'])) && ctype_digit($_GET['seasonId'])) {
    $seasonId = (int)$_GET['seasonId'];
} else {
    header("Location: /index.php ");
    exit;
}

try {
    $webpage = new AppWebPage();

    $season = Entity\Season::findBySeasonId($seasonId);
    $webpage->setTitle("{$season->getName()}");

    $string = AppWebPage::escapeString($season->getName());

    $bd = Entity\Collection\TvShowCollection::findAll();

    foreach ($bd as $album) {
        $year = $album->getYear();
        $name = AppWebPage::escapeString($album->getName());
        $webpage->appendContent(
            <<<HTML
                <div class='album'>
                    <img src="http://localhost:8000/cover.php?coverId={$album->getCoverId()}" class="album__cover">
                    <p class='album__year'>{$year}</p>
                    <p class='album__name'>{$name}</p>
                </div>

HTML
        );
    }

    echo $webpage->toHTML();
} catch (EntityNotFoundException) {
    http_response_code(404);
}

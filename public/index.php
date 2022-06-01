<?php
declare(strict_types=1);

use Entity\Collection\TvShowCollection;
use Html\WebPage;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle("Series TV");

$webPage->appendContent("<div class='list'>");

foreach (TvShowCollection::findAll() as $show) {
    $webPage->appendContent("<div class='serie'><div class='serie__image'><img src='poster.php?posterId=".$show->getPosterId()."' alt='poster de la série'></div> <div class='serie__txt'><a href='season.php?seasonId='".$show->getId()."><h3>".WebPage::escapeString("{$show->getName()}")."</h3></a><p>".$show->getOverview()."</p></div></div><br/>");
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();

<?php
declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvShowCollection;
use Html\WebPage;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle("Series TV");

$webPage->appendContent("<label for='select__genre'>Triez par : </label>");
$webPage->appendContent("<select name='select__genre' class='select__genre'><option value=''>--Choisir un genre--</option>");
foreach (GenreCollection::findAllGenre() as $genre){
    $name = WebPage::escapeString($genre->getName());
    $webPage->appendContent("<option value='$name'>$name</option>");
}
$webPage->appendContent("</select>");

$webPage->appendContent("<div class='list' id='list__serie'>");

foreach (TvShowCollection::findAll() as $show) {
    $idShow = $show->getId();
    $webPage->appendContent("<div class='serie'  onclick=\"location.href='season.php?seasonId=$idShow';\" ><div class='serie__image'><img src='poster.php?posterId=".$show->getPosterId()."' alt='poster de la série'></div> <div class='serie__txt'><h3>".WebPage::escapeString("{$show->getName()}")."</h3><p>".$show->getOverview()."</p></div></div>");
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();

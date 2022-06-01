<?php
declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvShowCollection;
use Html\WebPage;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle("Series TV");

//------------Liste déroulante -------

$webPage->appendContent("<div class='selection'> <form method='get' action='index.php'>");
$webPage->appendContent("<label for='select__genre'>Triez par : </label>");
$webPage->appendContent("<select  name='genre' class='select__genre'><option value='' selected disabled>--Choisir un genre--</option>");

$i = 1;
foreach (GenreCollection::findAllGenre() as $genre){

    $name = WebPage::escapeString($genre->getName());
    $webPage->appendContent("<option value='$i'>$name</option>");
    $i++;
}
$webPage->appendContent("</select><input type='submit' value='Trier' class='section__btn'></form></div>");


//---liste des séries

$webPage->appendContent("<div class='list' id='list__serie'>");

foreach (TvShowCollection::findAll() as $show) {
    $idShow = $show->getId();
    $webPage->appendContent("<div class='serie'  onclick=\"location.href='season.php?seasonId=$idShow';\" ><div class='serie__image'><img src='poster.php?posterId=".$show->getPosterId()."' alt='poster de la série'></div> <div class='serie__txt'><h3>".WebPage::escapeString("{$show->getName()}")."</h3><p>".$show->getOverview()."</p></div></div>");
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();

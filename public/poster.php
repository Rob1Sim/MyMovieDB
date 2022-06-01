<?php
declare(strict_types=1);



use Entity\Collection\PosterCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if ((isset($_GET["posterId"]) && ctype_digit($_GET["posterId"]))) {
        $id = $_GET["posterId"];
        $poster = PosterCollection::findPosterById((int)$id);
        header("Content-Type: image/jpeg; ");
        echo $poster->getJpeg();
    } else {
        http_response_code(400);
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

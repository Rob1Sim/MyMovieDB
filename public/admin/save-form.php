<?php
declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Html\Form\tvShowForm;

try {
    $tvShow = new tvShowForm();
    $tvShow->setEntityFromQueryString();
    $tvShow->getTvShow()->save();
    header("Location: /");


} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

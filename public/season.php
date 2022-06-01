<?php
declare(strict_types=1);


if (isset($_GET['seasonId']) && !empty(($_GET['seasonId'])) && ctype_digit($_GET['seasonId'])) {
    $artistId = (int)$_GET['seasonId'];
} else {
    header("Location: /index.php ");
    exit;
}


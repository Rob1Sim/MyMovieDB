<?php

declare(strict_types=1);

namespace Entity\Exception;

use OutOfBoundsException;

/***
 * S'occupe de d'afficher les problème si une entité n'est pas créer
 */
class EntityNotFoundException extends OutOfBoundsException
{
}

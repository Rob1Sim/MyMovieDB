<?php

declare(strict_types=1);

namespace Entity\Exception;

use OutOfBoundsException;

/***
 * S'occupe d'afficher les problèmes si une entitée n'est pas créée
 */
class EntityNotFoundException extends OutOfBoundsException
{
}

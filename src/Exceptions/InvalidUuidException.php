<?php

namespace Olsza\ValueObjects\Exceptions;

class InvalidUuidException extends \Exception
{
    protected $message = 'Uuid is invalid.';
}

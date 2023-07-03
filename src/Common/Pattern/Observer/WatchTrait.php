<?php

namespace Diagnolek\Common\Pattern\Observer;

trait WatchTrait
{
    public static function watch(SubjectAbstract $subject): void
    {
        new self($subject);
    }

}

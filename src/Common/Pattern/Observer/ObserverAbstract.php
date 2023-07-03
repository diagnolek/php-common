<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\Observer;

abstract class ObserverAbstract implements \SplObserver
{

    protected SubjectAbstract $subject;

    public function __construct(SubjectAbstract $subject)
    {
        $this->subject = $subject;
        $subject->attach($this);
    }


    public function update(\SplSubject $subject): void
    {
        if ($subject === $this->subject) {
            $this->doUpdate($subject);
        }
    }

    abstract protected function doUpdate(SubjectAbstract $subject): void;
    abstract public static function watch(SubjectAbstract $subject): void;

}

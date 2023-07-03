<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Common\Pattern\Observer;

abstract class SubjectAbstract implements \SplSubject
{

    protected \SplObjectStorage $storage;

    public function __construct()
    {
        $this->storage = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer): void
    {
        $this->storage->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->storage->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->storage as $obs) {
            $obs->update($this);
        }
    }

}

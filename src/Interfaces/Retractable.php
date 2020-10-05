<?php

namespace Vrnvgasu\Retractor\Interfaces;

interface Retractable
{
    /**
     * @param null $data
     */
    public function retract($data = null): void;

    /**
     * @param null $data
     * @return bool
     */
    public function tryToProvide($data = null): bool;
}

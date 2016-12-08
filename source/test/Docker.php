<?php
declare(strict_types=1);

namespace test;

class Docker
{
    /**
     * @param int $value
     *
     * @return string
     */
    public function get(int $value) : string
    {
        $return = 'false';

        if ($value < 7) {
            $return = 'true';
        }

        return $return;
    }
}

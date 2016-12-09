<?php
namespace source\docker;

class Start
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

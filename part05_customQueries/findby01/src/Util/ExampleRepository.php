<?php

namespace App\Util;

/*
 * class to demonstrate how __call can be used by Doctrine repositories ...
 */

class ExampleRepository
{
    public function findAll()
    {
        return 'you called method findAll()';
    }

    public function __call($methodName, $arguments)
    {
        $html = '';
        $argsString = implode(', ', $arguments) . "\n";

        $html .= "you called method $methodName\n";
        $html .= "with arguments: $argsString\n";

        $result = $this->startsWithFindBy($methodName);
        if ($result) {
            $html .= "since the method called started with 'findBy'"
                . "\n it looks like you were searching by property '$result'\n";
        }

        return $html;
    }

    private function startsWithFindBy($name)
    {
        $needle = 'findBy';
        $pos = strpos($name, $needle);

        // since 0 would evaluate to FALSE, must use !== not simply !=
        if (($pos !== false) && ($pos == 0)) {
            return substr($name, strlen($needle)); // text AFTER findBy
        }

        return false;
    }
}
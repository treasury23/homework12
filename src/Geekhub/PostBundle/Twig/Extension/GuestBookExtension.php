<?php

namespace Geekhub\PostBundle\Twig\Extension;

class GuestBookExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'limitSymbol' => new \Twig_Filter_Method($this, 'limitSymbolFilter')
        );
    }

    public function limitSymbolFilter($str, $number)
    {
        if (strlen($str)>$number) {
            $newStr = substr($str,0,$number);
            $newStr .= "...";

            return $newStr;

        } else {
            return $str;
        }
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'guestbook_extension';
    }
}
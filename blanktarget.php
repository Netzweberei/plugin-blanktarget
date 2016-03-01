<?php
use Herbie\Hook;

class BlanktargetPlugin
{
    public static function install()
    {
        Hook::attach('renderContent', ['BlanktargetPlugin', 'renderContent'], 11);
    }

    public static function renderContent($content)
    {
        $replacements = [];
        preg_match_all('/title=(?P<delim>\"|\')_(?P<title>.+)\1/', $content, $titles);
        foreach($titles['title'] as $i => $title){
            $replacements[$titles['delim'][$i].'_'.$title.$titles['delim'][$i]] = $titles['delim'][$i].$title.$titles['delim'][$i].' target="_blank"';
        }
        return strtr($content, $replacements);
    }
}

BlanktargetPlugin::install();
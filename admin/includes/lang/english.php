<?php


function lang($phrase)
{
    static $lang = [
        'MASSAGE' => 'Welcome'
    ];
    return $lang[$phrase];
};

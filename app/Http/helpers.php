<?php

if (!function_exists('backgroundChooser')) {
    /**
     * Randomly select a background colour from the array.
     *
     * @return string
     */
    function backgroundChooser()
    {
        $colors=array('grey','black','red','orange','orchid','green','blue','darkBlue');
        return $colors[array_rand($colors,1)];
    }
}


if (!function_exists('characterName')) {
    /**
     * Return name of key.
     *
     * @return string
     */
    function characterName($key)
    {
        switch($key)
        {
            case 16:
                $name='Del/Backspace';
                break;
            default:
                $name =chr($key);
        }

        return $name;
    }
}
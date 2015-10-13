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
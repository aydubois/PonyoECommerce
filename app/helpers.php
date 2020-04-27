<?php

use Illuminate\Support\Arr;
    function array_undot($arrayDot){
        $array = [];
        foreach($arrayDot as $key=>$value){
            Arr::set($array, $key, $value);
        }

        return $array;
    }

    function arrays_merge_recursive_distinct($array1, $array2){
        $array1dot = Arr::dot($array1);
        $array2dot = Arr::dot($array2);

        $arrayMergeDot = array_merge($array1dot, $array2dot);
        return array_undot($arrayMergeDot);
    }

<?php

use Illuminate\Support\Facades\Auth;

function admin(){
    return Auth::guard('admin')->user();
}
function user(){
    return Auth::guard('web')->user();
}
function storage_url($urlOrArray)
{
    $no_image = asset('no_img/no_img.jpg');
    if (is_array($urlOrArray) || is_object($urlOrArray)) {
        $result = '';
        $count = 0;
        $itemCount = count($urlOrArray);
        foreach ($urlOrArray as $index => $url) {

            $result .= $url ? asset('storage/' . $url) : $no_image;

            if ($count === $itemCount - 1) {
                $result .= '';
            } else {
                $result .= ', ';
            }
            $count++;
        }
        return $result;
    } else {
        return $urlOrArray ? asset('storage/' . $urlOrArray) : $no_image;
    }
}

function auth_storage_url($url, $gender = false)
{
    $image = asset('no_img/other-1.png');
    if ($gender == 1) {
        $image = asset('no_img/male-1.jpeg');
    } elseif ($gender == 2) {
        $image = asset('no_img/female-1.jpg');
    }
    return $url ? asset('storage/' . $url) : $image;
}



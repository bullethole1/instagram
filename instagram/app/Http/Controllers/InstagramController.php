<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function showImages()
    {
        $images = Image::all();

        return View('/welcome', ['images' => $images]);
    }
}
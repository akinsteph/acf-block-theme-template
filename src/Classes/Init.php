<?php

namespace AbttWP\Classes;

class Init
{
    public static function init() {
        Social::get_instance();
        Blog::get_instance();
    }
}

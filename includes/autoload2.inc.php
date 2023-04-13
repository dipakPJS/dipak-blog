<?php

spl_autoload_register(function ($className) {
    include 'config/'.$className.'.php';
});

<?php

if(!file_exists('view')) {
    function view($filePath) {
        return new View($filePath);
    }
}
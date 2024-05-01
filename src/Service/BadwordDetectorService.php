<?php

namespace App\Service;

class BadwordDetectorService
{
    private $badwords;

    public function __construct()
    {
        $this->badwords = file(__DIR__ . '/../../badwords.txt', FILE_IGNORE_NEW_LINES);
    }

    public function detect(string $text): bool
    {
        foreach ($this->badwords as $badword) {
            if (stripos($text, $badword) !== false) {
                return true;
            }
        }

        return false;
    }
}
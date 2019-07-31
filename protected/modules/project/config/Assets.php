<?php

class Assets extends AssetsBundle
{
    public $js      = [];
    public $css     = [];
    public $depends = [];

    /**
     *
     * @var type
     */
    public $controller = [
        "overview" => [
            "js"      => ["overview.js"],
            "css"     => [],
            "depends" => ["tablePlugin", "alertPlugin"],
        ],
        "manage" => [
            "js"      => ["manage.js"],
            "css"     => [],
            "depends" => ["jquery-validation", "alertPlugin"],
        ]
    ];
    public $action     = [
        "manage.users"  => [
            "js"      => ["users.js"],
            "css"     => [],
            "depends" => ["tablePlugin"],
        ],
    ];
}

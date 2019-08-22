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
            "js"      => ["overview"],
            "css"     => [],
            "depends" => ["tablePlugin", "alertPlugin"],
        ],
        "manage" => [
            "js"      => ["manage"],
            "css"     => [],
            "depends" => ["jquery-validation", "alertPlugin"],
        ]
    ];
    public $action     = [
        "manage.users"  => [
            "js"      => ["users"],
            "css"     => [],
            "depends" => ["tablePlugin"],
        ],
    ];
}

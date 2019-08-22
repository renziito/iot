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
            "depends" => ["alertPlugin"],
        ]
    ];
    public $action     = [
        "overview.index"  => [
            "js"      => [],
            "css"     => [],
            "depends" => [],
        ],
    ];
}

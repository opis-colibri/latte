<?php
namespace PHPSTORM_META {
    override(\Opis\Colibri\Core\ItemCollector::collect(0), map([
        'latte-filters' => \Opis\Colibri\Serializable\Collection::class,
        'latte-macros' => \Opis\Colibri\Serializable\Collection::class,
    ]));

    override(\Opis\Colibri\collect(0), map([
        'latte-filters' => \Opis\Colibri\Serializable\Collection::class,
        'latte-macros' => \Opis\Colibri\Serializable\Collection::class,
    ]));
}
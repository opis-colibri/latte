<?php
namespace PHPSTORM_META {

    override(\Opis\Colibri\Collector\Manager::collect(0), map([
        'latte-filters' => \Opis\Colibri\Modules\Latte\Collector\LatteContainer::class,
        'latte-macros' => \Opis\Colibri\Modules\Latte\Collector\LatteContainer::class,
    ]));

    override(\Opis\Colibri\Functions\collect(0), map([
        'latte-filters' => \Opis\Colibri\Modules\Latte\Collector\LatteContainer::class,
        'latte-macros' => \Opis\Colibri\Modules\Latte\Collector\LatteContainer::class,
    ]));
}
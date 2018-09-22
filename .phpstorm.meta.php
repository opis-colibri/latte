<?php
namespace PHPSTORM_META {
    override(\Opis\Colibri\Collector\Manager::collect(0), map([
        'latte-filters' => \Opis\Colibri\Serializable\CallbackList::class,
        'latte-macros' => \Opis\Colibri\Serializable\CallbackList::class,
    ]));

    override(\Opis\Colibri\Functions\collect(0), map([
        'latte-filters' => \Opis\Colibri\Serializable\CallbackList::class,
        'latte-macros' => \Opis\Colibri\Serializable\CallbackList::class,
    ]));
}
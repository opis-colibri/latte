<?php
/* ===========================================================================
 * Copyright 2018 Zindex Software
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

namespace Opis\Colibri\Modules\Latte\Test;

use Opis\Colibri\Application;
use Opis\Colibri\Modules\Latte\Collector\LatteFilterCollector;
use Opis\Colibri\Modules\Latte\Collector\LatteMacroCollector;
use PHPUnit\Framework\TestCase;

class BaseClass extends TestCase
{
    /** @var Application */
    protected $app;

    public function setUp()
    {
        $this->app = include __DIR__ . '/app/app.php';
        $collector = $this->app->getCollector();
        $collector->register(LatteFilterCollector::NAME, LatteFilterCollector::class, '');
        $collector->register(LatteMacroCollector::NAME, LatteMacroCollector::class, '');
        $collector->recollect(true);
        $this->app->getViewRenderer()->handle('{name}.latte', function ($name) {
            return __DIR__ . "/views/{$name}.latte";
        });
        $collector->getTranslations()->addTranslations('example', [
            'key1' => 'T-KEY1'
        ]);
    }
}
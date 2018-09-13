<?php
/* ============================================================================
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

namespace Opis\Colibri\Modules\Latte;

use Latte\Engine;
use Opis\View\{
    IEngine, ViewRenderer
};
use function Opis\Colibri\Functions\{
    info, app
};

class LatteEngine implements IEngine
{
    /** @var Engine */
    protected $latte;

    /**
     * @param ViewRenderer $renderer
     */
    public function __construct(ViewRenderer $renderer)
    {
        $info = info();

        $this->latte = new Engine();
        $this->latte->setLoader(new LatteFileLoader($renderer, $info->rootDir()));
        $this->latte->setTempDirectory($info->writableDir() . '/latte');

        $this->initEnvironment($this->latte);
    }

    /**
     * @param Engine $latte
     */
    protected function initEnvironment(Engine $latte)
    {
        if (info()->installMode()) {
            $filters = $macros = [];
        }
        else {
            $collector = app()->getCollector();

            /** @var callable[] $filters */
            $filters = $collector->collect(Collector\LatteFilterCollector::NAME)->getList();

            /** @var callable[] $filters */
            $macros = $collector->collect(Collector\LatteMacroCollector::NAME)->getList();
        }

        $ns = 'Opis\Colibri\Functions\\';

        $filters += [
            'asset' => $ns. 'asset',
            'csrf' => $ns . 'generateCSRFToken',
            'url' => $ns . 'getURL',
            't' => $ns . 't',
            'translate' => $ns . 't',
            'r' => $ns . 'r',
            'view' => $ns . 'view',
            'render' => $ns . 'render',
        ];

        foreach ($filters as $name => $filter) {
            $latte->addFilter($name, $filter);
        }

        foreach ($macros as $name => $macro) {
            $latte->addMacro($name, $macro($latte));
        }
    }

    /**
     * @inheritDoc
     */
    public function build(string $path, array $vars = []): string
    {
        return $this->latte->renderToString($path, $vars);
    }

    /**
     * @inheritDoc
     */
    public function canHandle(string $path): bool
    {
        return (bool) preg_match('/^.*\.latte$/', $path);
    }

    /**
     * @param ViewRenderer $renderer
     * @return LatteEngine
     */
    public static function factory(ViewRenderer $renderer): self
    {
        return new static($renderer);
    }
}
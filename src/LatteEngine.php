<?php
/* ============================================================================
 * Copyright 2018-2020 Zindex Software
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
    Renderer,
    Engine as ViewEngine
};
use function Opis\Colibri\{info, collect};

class LatteEngine implements ViewEngine
{
    protected Engine $latte;

    /**
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
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
    protected function initEnvironment(Engine $latte): void
    {
        $filters = collect(Collector\LatteFilterCollector::class)->getEntries();
        $macros = collect(Collector\LatteMacroCollector::class)->getEntries();

        $ns = '\Opis\Colibri\\';

        $filters += [
            'asset' => $ns . 'asset',
            'csrf' => $ns . 'generateCSRFToken',
            'url' => $ns . 'getURI',
            't' => $ns . 't',
            'tns' => $ns . 'tns',
            'translate' => $ns . 't',
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
        return (bool)preg_match('/^.*\.latte$/', $path);
    }

    /**
     * @param Renderer $renderer
     * @return LatteEngine
     */
    public static function factory(Renderer $renderer): self
    {
        return new static($renderer);
    }
}
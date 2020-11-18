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

use RuntimeException;
use Latte\Loader;
use Opis\View\Renderer;

class LatteFileLoader implements Loader
{
    protected Renderer $renderer;
    protected ?string $root = null;
    protected int $rootLen = 0;

    /**
     * LatteFileLoader constructor.
     * @param Renderer $renderer
     * @param string|null $rootPath
     */
    public function __construct(Renderer $renderer, ?string $rootPath = null)
    {
        $this->renderer = $renderer;
        if ($rootPath !== null) {
            $this->root = trim($rootPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
            $this->rootLen = strlen($this->root);
        }
    }

    /**
     * @inheritDoc
     */
    public function getContent($name)
    {
        $path = $this->find($name);

        if ($path === null) {
            throw new RuntimeException("View {$name} was not found");
        }

        return file_get_contents($path);
    }

    /**
     * @inheritDoc
     */
    public function isExpired($name, $time)
    {
        $path = $this->find($name);

        if ($path === null) {
            throw new RuntimeException("View {$name} was not found");
        }

        return filemtime($this->find($name)) > $time;
    }

    /**
     * @inheritDoc
     */
    public function getReferredName($name, $referringName)
    {
        $result = $this->find($name);
        if ($result === null) {
            throw new RuntimeException("View {$name} was not found");
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getUniqueId($name)
    {
        $path = $this->find($name);
        if ($path === null) {
            throw new RuntimeException("View {$name} was not found");
        }

        // If path is a local file, strip root path
        // In this way you can move the app to another dir, without a cache rebuild
        if ($this->rootLen > 0 && strpos($path, $this->root) === 0) {
            $path = substr($path, $this->rootLen);
        }

        return md5($path);
    }

    /**
     * @param $name
     * @return string|null
     */
    protected function find(string $name): ?string
    {
        if (file_exists($name)) {
            return $name;
        }

        return $this->renderer->resolveViewName($name);
    }
}
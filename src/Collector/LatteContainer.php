<?php
/* ============================================================================
 * Copyright © 2013-2018 The Opis Project
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

namespace OpisColibri\Latte\Collector;

use Serializable;
use Opis\Closure\SerializableClosure;

class LatteContainer implements Serializable
{
    /** @var callable[] */
    protected $data = [];

    /**
     * @param string $name
     * @param callable $callback
     */
    public function register(string $name, callable $callback)
    {
        $this->data[$name] = $callback;
    }

    /**
     * @return callable[]
     */
    public function getList(): array
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        SerializableClosure::enterContext();

        $data = $this->data;

        foreach ($data as &$value) {
            if ($value instanceof \Closure) {
                $value = SerializableClosure::from($value);
            }
        }

        $data = serialize($data);

        SerializableClosure::exitContext();

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        foreach ($data as &$value) {
            if ($value instanceof SerializableClosure) {
                $value = $value->getClosure();
            }
        }
        $this->data = $data;
    }
}
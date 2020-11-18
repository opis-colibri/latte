<?php
/* ===========================================================================
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

namespace Opis\Colibri\Modules\Latte\Test;

use function Opis\Colibri\view as v;

class RenderTest extends BaseClass
{
    public function testVariables()
    {
        $this->assertEquals("test-OK", v('variables.latte', [
            'a' => 'test',
            'b' => 'ok'
        ]));
    }

    public function testLoops()
    {
        $this->assertEquals("- 1\n- 2\n- 3\n", v('loop1.latte', [
            'items' => [1, 2, 3]
        ]));

        $this->assertEquals("<ol>\n<li>1</li>\n<li>2</li>\n<li>3</li>\n</ol>", v('loop2.latte', [
            'items' => [1, 2, 3]
        ]));
    }

    public function testInclude()
    {
        $this->assertEquals("Including included.latte\nThis is included", v('include.latte', [
            'file' => 'included.latte'
        ]));
    }

    public function testTranslation()
    {
        $this->assertEquals('T-KEY1', v('t.latte', ['key' => 'example:key1']));
    }

    public function testEscape()
    {
        $this->assertEquals("&lt;b&gt;escaped&lt;/b&gt;\n", v('escape.latte', [
            'escape' => true,
            'content' => '<b>escaped</b>'
        ]));

        $this->assertEquals("<b>escaped</b>\n", v('escape.latte', [
            'escape' => false,
            'content' => '<b>escaped</b>'
        ]));
    }

    public function testFilters()
    {
        $this->assertEquals('filtered:message', v('filter.latte', [
            'content' => 'message'
        ]));
    }
}
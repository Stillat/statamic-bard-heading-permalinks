<?php

use Stillat\StatamicBardHeadingPermalinks\HeadingPermalinkExtension;

test('min max heading levels can be configured', function () {
    HeadingPermalinkExtension::registerAll();

    $data = [
        [
            'type' => 'heading',
            'attrs' => [
                'level' => 1,
            ],
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Heading 1',
                ],
            ],
        ],
        [
            'type' => 'paragraph',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Paragraph 1',
                ],
            ],
        ],
        [
            'type' => 'heading',
            'attrs' => [
                'level' => 2,
            ],
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Heading 2',
                ],
            ],
        ],
        [
            'type' => 'paragraph',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Paragraph 2',
                ],
            ],
        ],
        [
            'type' => 'heading',
            'attrs' => [
                'level' => 3,
            ],
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Heading 3',
                ],
            ],
        ],
        [
            'type' => 'paragraph',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Paragraph 3',
                ],
            ],
        ],
        [
            'type' => 'heading',
            'attrs' => [
                'level' => 4,
            ],
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Heading 4',
                ],
            ],
        ],
        [
            'type' => 'paragraph',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Paragraph 4',
                ],
            ],
        ],
    ];

    config(['bard_permalinks.config.min_heading_level' => 2]);
    config(['bard_permalinks.config.max_heading_level' => 3]);

    expect(bard()->augment($data))->toBe('<h1>Heading 1</h1><p>Paragraph 1</p><h2><a id="content-heading-2" href="#content-heading-2" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 2</h2><p>Paragraph 2</p><h3><a id="content-heading-3" href="#content-heading-3" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 3</h3><p>Paragraph 3</p><h4>Heading 4</h4><p>Paragraph 4</p>');
});

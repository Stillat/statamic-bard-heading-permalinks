<?php

use Stillat\StatamicBardHeadingPermalinks\HeadingPermalinkExtension;

test('fragment prefix can be set', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.fragment_prefix' => 'test']);

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
    ];

    expect(bard()->augment($data))->toBe('<h1><a id="content-heading-1" href="#test-heading-1" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 1</h1>');
});

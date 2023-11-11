<?php

use Stillat\StatamicBardHeadingPermalinks\HeadingPermalinkExtension;

test('heading class can be set', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.heading_class' => 'theheadingclass']);

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

    expect(bard()->augment($data))->toBe('<h1 class="theheadingclass"><a id="content-heading-1" href="#content-heading-1" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 1</h1>');
});

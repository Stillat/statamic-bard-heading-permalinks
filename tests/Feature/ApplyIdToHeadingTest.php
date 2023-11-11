<?php

use Stillat\StatamicBardHeadingPermalinks\HeadingPermalinkExtension;

test('ids can be applied to headings', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.apply_id_to_heading' => true]);

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

    expect(bard()->augment($data))->toBe('<h1 id="content-heading-1"><a href="#content-heading-1" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 1</h1>');
});

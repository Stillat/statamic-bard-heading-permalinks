<?php

use Stillat\StatamicBardHeadingPermalinks\HeadingPermalinkExtension;

function testData(): array
{
    return [
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
    ];
}

test('permalinks can be added to headings', function () {
    HeadingPermalinkExtension::registerAll();

    expect(bard()->augment(testData()))->toBe('<h1><a id="content-heading-1" href="#content-heading-1" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 1</h1><p>Paragraph 1</p><h2><a id="content-heading-2" href="#content-heading-2" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 2</h2><p>Paragraph 2</p>');
});

test('permalink id prefix can be changed', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.id_prefix' => 'test']);

    expect(bard()->augment(testData()))->toBe('<h1><a id="test-heading-1" href="#content-heading-1" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 1</h1><p>Paragraph 1</p><h2><a id="test-heading-2" href="#content-heading-2" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 2</h2><p>Paragraph 2</p>');
});

test('permalink symbol can be changed', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.symbol' => 'custom symbol']);

    expect(bard()->augment(testData()))->toBe('<h1><a id="content-heading-1" href="#content-heading-1" class="heading-permalink" aria-hidden="true" title="Permalink">custom symbol</a>Heading 1</h1><p>Paragraph 1</p><h2><a id="content-heading-2" href="#content-heading-2" class="heading-permalink" aria-hidden="true" title="Permalink">custom symbol</a>Heading 2</h2><p>Paragraph 2</p>');
});

test('permalink can be inserted before', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.insert' => 'before']);

    expect(bard()->augment(testData()))->toBe('<h1><a id="content-heading-1" href="#content-heading-1" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 1</h1><p>Paragraph 1</p><h2><a id="content-heading-2" href="#content-heading-2" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a>Heading 2</h2><p>Paragraph 2</p>');
});

test('permalink can be inserted after', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.insert' => 'after']);

    expect(bard()->augment(testData()))->toBe('<h1>Heading 1<a id="content-heading-1" href="#content-heading-1" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a></h1><p>Paragraph 1</p><h2>Heading 2<a id="content-heading-2" href="#content-heading-2" class="heading-permalink" aria-hidden="true" title="Permalink">¶</a></h2><p>Paragraph 2</p>');
});

test('permalink insert none', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.insert' => 'none']);

    expect(bard()->augment(testData()))->toBe('<h1>Heading 1</h1><p>Paragraph 1</p><h2>Heading 2</h2><p>Paragraph 2</p>');
});

test('permalink html_class can be changed', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.html_class' => 'custom-class']);

    expect(bard()->augment(testData()))->toBe('<h1><a id="content-heading-1" href="#content-heading-1" class="custom-class" aria-hidden="true" title="Permalink">¶</a>Heading 1</h1><p>Paragraph 1</p><h2><a id="content-heading-2" href="#content-heading-2" class="custom-class" aria-hidden="true" title="Permalink">¶</a>Heading 2</h2><p>Paragraph 2</p>');
});

test('permalink aria hidden can be disabled', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.aria_hidden' => false]);

    expect(bard()->augment(testData()))->toBe('<h1><a id="content-heading-1" href="#content-heading-1" class="heading-permalink" title="Permalink">¶</a>Heading 1</h1><p>Paragraph 1</p><h2><a id="content-heading-2" href="#content-heading-2" class="heading-permalink" title="Permalink">¶</a>Heading 2</h2><p>Paragraph 2</p>');
});

test('permalink title can be changed', function () {
    HeadingPermalinkExtension::registerAll();

    config(['bard_permalinks.config.title' => 'Custom!']);

    expect(bard()->augment(testData()))->toBe('<h1><a id="content-heading-1" href="#content-heading-1" class="heading-permalink" aria-hidden="true" title="Custom!">¶</a>Heading 1</h1><p>Paragraph 1</p><h2><a id="content-heading-2" href="#content-heading-2" class="heading-permalink" aria-hidden="true" title="Custom!">¶</a>Heading 2</h2><p>Paragraph 2</p>');
});

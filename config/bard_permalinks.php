<?php

use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer;

return [
    'config' => [
        'html_class' => config('statamic.markdown.configs.default.heading_permalink.html_class', 'heading-permalink'),
        'id_prefix' => config('statamic.markdown.configs.default.heading_permalink.id_prefix', 'content'),
        'apply_id_to_heading' => config('statamic.markdown.configs.default.heading_permalink.apply_id_to_heading', false),
        'heading_class' => config('statamic.markdown.configs.default.heading_permalink.heading_class', ''),
        'fragment_prefix' => config('statamic.markdown.configs.default.heading_permalink.fragment_prefix', 'content'),
        'insert' => config('statamic.markdown.configs.default.heading_permalink.insert', 'before'),
        'min_heading_level' => config('statamic.markdown.configs.default.heading_permalink.min_heading_level', 1),
        'max_heading_level' => config('statamic.markdown.configs.default.heading_permalink.max_heading_level', 6),
        'title' => config('statamic.markdown.configs.default.heading_permalink.title', 'Permalink'),
        'symbol' => config('statamic.markdown.configs.default.heading_permalink.symbol', HeadingPermalinkRenderer::DEFAULT_SYMBOL),
        'aria_hidden' => config('statamic.markdown.configs.default.heading_permalink.aria_hidden', true),
    ],
];

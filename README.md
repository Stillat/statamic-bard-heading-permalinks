# Bard Heading Permalinks for Statamic

Bard Heading Permalinks is an addon for Statamic that can add permalinks automatically to headings, similar to how permalinks can be added to markdown content.

## How to Install

To install Bard Heading Permalinks run the following command from the root of your project:

``` bash
composer require stillat/statamic-bard-heading-permalinks
```

## How to Use

Once installed you will need to register the Bard extensions provided by this addon. This is typically done within your site's `AppServiceProvider`.

Bard Heading Permalinks provides two different extensions:

* `Permalink`: Responsible for rendering the embedded link within headings
* `HeadingPermalinkExtension`: Adds the permalink, and any other details to rendered headings

For convenience, both extensions may be registered at once:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stillat\StatamicBardHeadingPermalinks\HeadingPermalinkExtension;

class AppServiceProvider
{
    public function boot()
    {
        // Register all heading permalink extensions.
        HeadingPermalinkExtension::registerAll();
    }
}
```

> Note: The `HeadingPermalinkExtension` will replace any existing heading extension.

## Configuration

By default, Bard Heading Permalinks will utilize the `heading_permalink` settings for the *default* markdown parser. For more information on configuring Statamic's markdown parsers, consider reading the official documentation here: [https://statamic.dev/extending/markdown#configuration](https://statamic.dev/extending/markdown#configuration).

However, you may publish Bard Heading Permalink's configuration file to override any settings by running the following command from the root of your project:

```bash
php artisan vendor:publish --tag=bard-permalinks-config
```

A new file will be created at `config/bard_permalinks.php`, with the following contents:

```php
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

```

Bard Heading Permalinks supports all documented configuration options provided by CommonMark's Heading Permalink Extension. For more information on each configuration option, please consult their documentation page here: [https://commonmark.thephpleague.com/2.4/extensions/heading-permalinks/](https://commonmark.thephpleague.com/2.4/extensions/heading-permalinks/).

## License

Bard Heading Permalinks is free software, released under the MIT license.

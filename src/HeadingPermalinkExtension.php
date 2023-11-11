<?php

namespace Stillat\StatamicBardHeadingPermalinks;

use Illuminate\Support\Str;
use Statamic\Fieldtypes\Bard\Augmentor;
use TipTap\Nodes\Heading as TipTapHeading;

class HeadingPermalinkExtension extends TipTapHeading
{
    /**
     * Registers both the `permalink` and `heading` extensions.
     *
     * Note: The heading extension will REPLACE the current heading extension.
     *
     * @return void
     */
    public static function registerAll()
    {
        Augmentor::addExtension('permalink', new Permalink());
        Augmentor::replaceExtension('heading', new HeadingPermalinkExtension());
    }

    private function getText($node)
    {
        $text = [];

        foreach ($node->content as $content) {
            if ($content->type == 'text') {
                $text[] = $content->text;
            }
        }

        return implode('', $text);
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        if (config('bard_permalinks.config.insert', 'before') == 'none') {
            return parent::renderHTML($node, $HTMLAttributes);
        }

        $prefix = config('bard_permalinks.config.id_prefix', 'content');

        if (mb_strlen(trim($prefix)) > 0) {
            $prefix .= '-';
        }

        $headingSlug = Str::slug($this->getText($node));
        $headingId = $prefix.$headingSlug;
        $level = $node->attrs->level;

        if ($level < config('bard_permalinks.config.min_heading_level', 1) ||
            $level > config('bard_permalinks.config.max_heading_level', 6)) {
            return parent::renderHTML($node, $HTMLAttributes);
        }

        $permalink = (object) [
            'type' => 'text',
            'marks' => [
                (object) [
                    'type' => 'permalink',
                    'attrs' => (object) [
                        'name' => $headingId,
                        'slug' => $headingSlug,
                        'rel' => null,
                        'target' => null,
                    ],
                ],
            ],
            'text' => config('bard_permalinks.config.symbol', '#'),
        ];

        if (config('bard_permalinks.config.insert', 'before') == 'before') {
            array_unshift($node->content, $permalink);
        } else {
            $node->content[] = $permalink;
        }

        if (config('bard_permalinks.config.apply_id_to_heading', false)) {
            $HTMLAttributes['id'] = $headingId;
        }

        $existingClass = $HTMLAttributes['class'] ?? '';
        $headingClass = config('bard_permalinks.config.heading_class', '');

        if (mb_strlen(trim($existingClass)) > 0) {
            $existingClass .= ' '.$headingClass;
        } else {
            $existingClass .= $headingClass;
        }

        $HTMLAttributes['class'] = $existingClass;

        return parent::renderHTML($node, $HTMLAttributes);
    }
}

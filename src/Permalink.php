<?php

namespace Stillat\StatamicBardHeadingPermalinks;

use Tiptap\Marks\Link;

class Permalink extends Link
{
    public static $name = 'permalink';

    public function renderHTML($mark, $HTMLAttributes = [])
    {
        if (! config('bard_permalinks.config.apply_id_to_heading', false)) {
            $HTMLAttributes['id'] = $mark->attrs->name;
        }

        $fragmentPrefix = config('bard_permalinks.config.fragment_prefix', 'content');

        if (mb_strlen(trim($fragmentPrefix)) > 0) {
            $fragmentPrefix .= '-';
        }

        $HTMLAttributes['href'] = '#'.$fragmentPrefix.$mark->attrs->slug;
        $HTMLAttributes['target'] = '';
        $HTMLAttributes['class'] = config('bard_permalinks.config.html_class', 'heading-permalink');

        if (config('bard_permalinks.config.aria_hidden', true)) {
            $HTMLAttributes['aria-hidden'] = 'true';
        }

        $HTMLAttributes['title'] = config('bard_permalinks.config.title', 'Link to this section');
        $HTMLAttributes['rel'] = null;

        return parent::renderHTML($mark, $HTMLAttributes);
    }
}

<?php
/**
 * craft-widow-no-mo plugin for Craft CMS 3.x
 *
 * Preventz 'widows' in ur outputz.
 *
 * @link      http://boots.media
 * @copyright Copyright (c) 2018 Boots
 */

namespace bootsified\craftwidownomo\twigextensions;

use bootsified\craftwidownomo\Craftwidownomo;

use Craft;
use craft\helpers\Template;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Boots
 * @package   Craftwidownomo
 * @since     1.0.0
 */
class CraftwidownomoTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Craftwidownomo';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'a string in your template' | widownomo }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('widownomo', [$this, 'widowNoMo']),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = widownomo('a string in your template') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('widownomo', [$this, 'widowNoMo']),
        ];
    }

    /**
     * Replaces the space between the nth-last words in a string with ``&nbsp;``
     * Works in these block tags ``(h1-h6, p, li)`` and also accounts for
     * potential closing inline elements ``a, em, strong, span, b, i``
     *
     * @param   $text Text to transform
     * @param   $numberOfWords Number of words to force break
     * @param   $outputRaw If we should output raw or not
     *
     * @return  The string with widows (hopefully) eliminated
     */
    public function widowNoMo($text = "", $numberOfWords = 1, $outputRaw = true)
    {
        $tags = "a|span|i|b|em|strong|acronym|caps|sub|sup|abbr|big|small|code|cite|tt";

		// Taken from https://github.com/davethegr8/cakephp-typogrify-helper/blob/master/views/helpers/typogrify.php
		// This regex is a beast, tread lightly
		$regex = "/([^\s])\s+(((<($tags)[^>]*>)*\s*[^\s<>]+)(<\/($tags)>)*[^\s<>]*\s*(<\/(p|h[1-6]|li)>|$))/i";
		$string = $text;

		for ($i = 0; $i < $numberOfWords; $i++) {
			$string = preg_replace($regex, '$1&nbsp;$2', $string);
		}

		return $outputRaw ? Template::raw($string) : $string;
    }
}

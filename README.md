# Widow No Mo plugin for Craft CMS 3.x

Preventz 'widows' in ur outputz.

![Logo](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require bootsified/craft-widow-no-mo

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for craft-widow-no-mo.

## Widow No Mo Overview

A 'widow' is when a single word in a block of text breaks to a line on it's own in your page. This filter places a `&nbsp;` between the last words of your string to insure that they break together, leaving both on the next line - no 'widows'.

## Using Widow No Mo

Use the `widownomo` filter on your string...
```
{% set myString = '<p>This is a string of text that might create a widow when the page is too narrow.</p>' %}
{{ myString | widownomo }}
```
...to prevent widows in the output...
```
<p>This is a string of text that might create a widow when the page is too&nbsp;narrow.</p>
```

## Credit
This is basically Craft v3 verion of the [Craft-Widont](https://github.com/alexbech/Craft-Widont) plugin from [Alexander Bech](https://github.com/alexbech).  All props go to him.  :raised_hands:

Brought to you by [Boots](http://boots.media)

# Readfile Filter plugin for Craft CMS 3.x

Exposes readfile() to twig template filter. Allows to display PDF files directly in the browser, obfuscating the real file path. Files of other types than PDF will download automatically.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require tlm/readfile-filter

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Readfile.

## Using Readfile in your templates

`{{ asset.one().url | readfile }}`
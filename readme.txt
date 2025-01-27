=== Ray ===
Contributors: freekmurze
Donate link: https://github.com/sponsors/spatie
Tags: development, debugging, debug, developer
Requires PHP: 8.0
Requires at least: 5.5
Tested up to: 6.7
Stable tag: 1.7.9
License: MIT

Easily debug WordPress sites using Ray.

== Description ==

[Ray](https://myray.app) is a beautiful, lightweight desktop app that helps you debug your app. There's a [free demo](https://myray.app) available that can be unlocked with a [license](https://spatie.be/products/ray).

After installing this plugin, you can use the `ray()` function to quickly dump stuff. Any variable(s) that you pass to `ray()` will be displayed.

Here some examples:

`
ray('Hello world');

ray(['a' => 1, 'b' => 2])->color('red');

ray('multiple', 'arguments', 'are', 'welcome');

ray()->showQueries();
`

There are many other helper functions available on Ray that allow you to display things that can help you debug such as [runtime and memory usage](https://spatie.be/docs/ray/v1/usage/framework-agnostic-php-project#measuring-performance-and-memory-usage), [queries that were executed](https://spatie.be/docs/ray/v1/usage/wordpress#showing-queries), and much more.

== Full Documentation ==

The extensive documentation can be found [here](https://spatie.be/docs/ray).

It contains the [installation instructions](https://spatie.be/docs/ray/v1/installation-in-your-project/wordpress) for WordPress.

After it is installed you can use any of the [framework agnostic](https://spatie.be/docs/ray/v1/usage/framework-agnostic-php-project) and [WordPress specific functions](https://spatie.be/docs/ray/v1/usage/wordpress).

== Changelog ==

You can find the changelog [at GitHub](https://github.com/spatie/wordpress-ray/blob/master/CHANGELOG.md).

== Upgrade Notice ==

You can find the changelog [at GitHub](https://github.com/spatie/wordpress-ray/blob/master/CHANGELOG.md).

== Screenshots ==

1. Here's how the Ray desktop app looks like.

![screenshot](https://spatie.be/docs/ray/v1/images/intro.jpg)

== Frequently Asked Questions ==

Want to know how to get started? Head over to [our extensive docs](https://spatie.be/docs/ray).

Want to report a bug? Create an issue at the [spatie/wordpress-ray](https://github.com/spatie/wordpress-ray) repo.

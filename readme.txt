=== Plugin Name ===
Contributors: z43 Studio
Donate link: http://z43studio.com/
Tags: code, development, blocks, post, syntax, highlighting, productivity, editor
Requires at least: 3.6
Tested up to: 4.1
Stable tag: 1.1.0.1

Add formatted source code blocks into your blog posts.

== Description ==

Codeblocks lets you add highlighted and formatted source code into your website without cluttering the visual editor. Write your code in individual blocks outside the built-in Content editor, and access these blocks simply by adding `[codeblock name='MY_BLOCK']` into your blog post or page. Codeblocks highlights the code on your website using [Rainbow.js](http://craig.is/making/rainbows), and themes can customize the color scheme of your code.

<http://z43studio.com/2014/05/codeblocks/>

**Theme editors:** See the Installation section for information on how to adjust Codeblocks options in your theme.

== Installation ==

The plugin is simple to install:

1. Download the Codeblocks plugin file (`.zip`)
2. Unzip and upload the plugin files folder to your `wp-content/plugins` folder
3. Go to the Plugins page and activate the Codeblocks plugin

While writing a post or page in your blog, add your code in the **Codeblocks** section of the Edit page. If this section does not show up, open the **Screen Options** dropdown from the top of the page and make sure Codeblocks is checked.

In your article content, you can access your blocks of code using `[codeblock name='MY_BLOCK']` where `MY_BLOCK` is whatever you titled your block of code. Codeblocks will automatically take care of setting up the highlighting feature on your website.

## Theme Editors

You can hook into `codeblocks/rainbow_theme` filter inside your `functions.php` file to change the Rainbow.js theme (there are many [themes on GitHub](https://github.com/ccampbell/rainbow/tree/master/themes)). Return a URL to the new theme stylesheet file, or `null` to disable highlighting, or `true` to only include the Rainbow.js file without a theme (useful if your themes already-loaded stylesheet file contains the code highlighting styles). Here's a few examples:

	add_filter('codeblocks/rainbow_theme', function($oldURL) {

		// Use the file 'cool-rainbow.css' inside our theme directory

		return plugins_url('cool-rainbow.css', __FILE__);
	});

You can also disable code highlighting with your theme by returning `null` in the filter.

	add_filter('codeblocks/rainbow_theme', function($oldURL) {

		// Disable code highlighting on our theme

		return null;
	});

If your theme's base stylesheet file already includes the Rainbow.js styles, just return `true` and we'll skip importing the stylesheets, and just load the Rainbow.js plugin.

	add_filter('codeblocks/rainbow_theme', function($oldURL) {

		// Add Rainbow.js tags, but don't include a separate stylesheet file

		return true;
	});

== Screenshots ==

1. Codeblocks adds source code editors below your main post body.

== Changelog ==

= 1.1.0.1 (current) =

* Updated to WordPress 4.1 Support

= 1.1.0 =

* Merged ACF Plugin dependency with Codeblocks

= 1.0.1 =

* Fixed an issue with CodeMirror dependencies
* Fixed an issue with PHP Language highlighting 

= 1.0 =

* Released. And awesome.
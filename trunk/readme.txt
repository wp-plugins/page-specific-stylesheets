=== Page Specific Stylesheets ===
Contributors: TylerShaw 
Tags: Stylesheet, CSS, Specific, Page, Post
Requires at least: 3.5
Tested up to: 3.9.1
Stable tag: 1.0.2

Adds a box allowing for the addition of page-specifc and post-specific CSS stylesheets. Reduces the need to edit and clutter up the style.css file.

== Description ==

**What's It Do?**

This plugin adds a box to your pages and posts allowing for page-specific or post-specific CSS stylesheets.


**Why Use It?**

After developing quite a few WordPress websites, it seems to me that the style.css file gets bloated. If you add a style used on only one page, and then later that page is deleted, you're visitors now have to download those styles that aren't even used. It's wasteful, but maintaining a clean style.css file requires an active effort. This plugin solves that by attaching the these styles to the page or post, allowing them to be updated just like the content is and deleted with the page.

It keeps your style.css file clean and reduces unused style clutter.

**New in Version 1.1**

A new Fancy Editor has been added utilizing CodeMirror to enhance the experience of editing your styles. As of right now, it is disabled by default, but provides these features when enabled:

*   Indenting
*   Valid / Invalid Rule Highlighting
*   Basic Auto-Complete (Ctrl+Shift)
*   Plus a few other features.

See the FAQs for info on the filter to enable the Fancy Editor.

**What About Efficiency?**

There shouldn't be an issue with overhead from the plugin. Admin code is only executed in the admin panel and front end code is executed on the front end. If you're website has a large amount of page-specific styles within it that can be migrated into the plugin, it can boost performance by reducing the download size of your style.css file.


**Roadmap**

The plugin is still rather simple. However, as I use it personally and at work, it will be maintained moving forward.

The following features are currently planned.


*   Custom post type support.
*   Options page with the ability to purge the database of style data.

If you have a feature idea, suggest it.


**Notes**

*   Style data is NOT removed on uninstall to prevent accidental deletion of important styles. The option to purge this data automatically is on the Roadmap as seen above. The meta_key used is pss_style if you need to delete it manually.


== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.
== Frequently Asked Questions ==

Q. How do I use it?

A. Simply install and activate the plugin. It will automatically add an additional box for CSS to be typed that will be injected into the page or post.


Q. How do I add the CSS box to custom post type?

A. As of version 1.0, you can't. This feature is on the to-do list for the near future.


Q. Is there some way to format the CSS in the box to be easier to read?

A. Sure. There is an optional (disabled by default) ability to enable a "Fancy" Editor. This includes line numbers, highlighting, and some basic auto-complete. Right now, you have to enable this manually using the filter below. Note: The ability to toggle this will be built into a settings page that is coming in the next release or so.

Filter (copy and paste into your themes functions.php file): 
function enable_fancy_editor() {
	return true;
}
add_filter('pss_fancy_editor', 'enable_fancy_editor'); 


Q. Why is the Fancy Editor disabled by default?

A. There are known plugin conflicts with many other plugins that utilize CodeMirror, the same utility used in the Fancy Editor. I am looking to remedy these conflicts but some of them are out of my control.


Q. How do I use auto-complete in the editor?

A. While typing a CSS property or value, you have to press Ctrl+Space. This will activate the auto-complete popup.

== Changelog ==

v1.0.2

- Fixed version number that was not updated properly.

v1.0.1

- Corrected random symbols scattered throughout the readme.txt.
- Corrected some typos.
- Added some additional information about meta data.

v1.0.0

- Initial release.
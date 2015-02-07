=== Page Specific Stylesheets ===
Contributors: TylerShaw 
Tags: Stylesheet, CSS, Specific, Page, Post
Requires at least: 3.5
Tested up to: 4.1
Stable tag: 1.2.2

Adds a box allowing for the addition of page-specifc and post-specific CSS stylesheets. Reduces the need to edit and clutter up the style.css file.

== Description ==

**What's It Do?**

This plugin adds a box to your pages and posts allowing for page-specific or post-specific CSS stylesheets.


**Why Use It?**

After developing quite a few WordPress websites, it seems to me that the style.css file gets bloated. If you add a style used on only one page, and then later that page is deleted, you're visitors now have to download those styles that aren't even used. It's wasteful, but maintaining a clean style.css file requires an active effort. This plugin solves that by attaching the these styles to the page or post, allowing them to be updated just like the content is and deleted with the page.

It keeps your style.css file clean and reduces unused style clutter.

**What About Efficiency?**

There shouldn't be an issue with overhead from the plugin. Admin code is only executed in the admin panel and front end code is executed on the front end. If you're website has a large amount of page-specific styles within it that can be migrated into the plugin, it can boost performance by reducing the download size of your style.css file.


**Roadmap**

This plugin will receive ongoing maintenance as WordPress evolves. No major features are planned, but I am entirely open to feature requests!

Feel free to suggest any feature you desire, or check out the code or contribute on [GitHub](https://github.com/tyler-shaw/page-specific-stylesheets), where the project is hosted.


*   Additional plugin options.

If you have a feature idea, suggest it.


**Notes**

*   Style data and options are not deleted by default on uninstall. You must check the options on the plugin settings page to enable the deletion of this data.


== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.
== Frequently Asked Questions ==

**Q. How do I use it?**

**A.** Simply install and activate the plugin. It will automatically add an additional box for CSS to be typed that will be injected into the page or post.


**Q. How do I add the CSS box to custom post type?**

**A.** The plugin has a settings page. You can check/uncheck various post types to enable to style editor box.


**Q. Is there some way to format the CSS in the box to be easier to read?**

**A.** Sure. There is an optional (disabled by default) ability to enable a "Fancy" Editor. This includes line numbers, highlighting, and some basic auto-complete. Right now, you have to enable this manually using the filter below. Note: The ability to toggle this will be built into a settings page that is coming in the next release or so.

Filter (copy and paste into your themes functions.php file): 
function enable_fancy_editor() {
	return true;
}
add_filter('pss_fancy_editor', 'enable_fancy_editor'); 


**Q. Why is the Fancy Editor disabled by default?**

**A.** There are known plugin conflicts with many other plugins that utilize CodeMirror, the same utility used in the Fancy Editor. I am looking to remedy these conflicts but some of them are out of my control.


**Q. How do I use auto-complete in the editor?**

**A.** While typing a CSS property or value, you have to press Ctrl+Space. This will activate the auto-complete popup.

== Changelog ==

v1.2.2

- Various typos

v1.2.1

- Verfied compatibility with WordPress 4.1.
- Moved project development to [GitHub](https://github.com/tyler-shaw/page-specific-stylesheets).
- Minfied various CSS files that are unlikely to change.
- Various minor improvements to README file, etc.
- Refactored some internal code to make the files neater.

v1.2.0

- Added a plugin settings page.
- Added custom post type support (this includes post type registered by other plugins, such as WooCommerce).
- Added an option to purge the database of style data on uninstall.
- Added an option to delete plugin settings from the database on uninstall.

v1.1.2

- Corrected text in the changelog.

v1.1.1

- Fixed a potential bug when emptying the post trash that could cause an error to be output or a white screen.
- Ensured WordPress 4.0 compatibility.

v1.1.0

- Added a new optional "Fancy Editor" utilizing CodeMirror to enhance CSS editing.
- Created a new `pss_fancy_editor` filter for enabling the optional editor. See FAQs for use details.
- Various readme updates and corrections.

Please Note: Enabling the Fancy Editor has the potential to cause conflict with other plugins that utilize CodeMirror. Updating will not enable the Fancy Editor by default.

v1.0.2

- Fixed version number that was not updated properly.

v1.0.1

- Corrected random symbols scattered throughout the readme.txt.
- Corrected some typos.
- Added some additional information about meta data.

v1.0.0

- Initial release.

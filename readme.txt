=== Remove Comment IPs ===
Contributors: geekysoft
Tags: comments, IP, privacy, GDPR
Requires at least: 4.6
Tested up to: 5.0.2
Stable tag: 1.0.2
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Removes the IP address of comment authors after 2 months.

== Description ==

Improve visitor privacy by removing their IP addresses from your database and free up some space in your database at the same time!

IP addresses are kept for 60 days to allow for spam fighting and troubleshooting. All the IP addresses stored with existing comments are removed six hours after activating the plugin.

The plugin is compatible with both IPv4 and IPv6.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/remove_comment_ips` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the ‘Plugins’ screen in WordPress.

No configuration is required or indeed possible.

== Frequently Asked Questions ==

= How come it’s not working? =

The IP address in existing comments are deleted six hours after you activate the plugin. For every plugin submitted fter you active the plugin, the IP address will be deleted after 60 days.

Please verify that you haven’t disabled WordPress’ cron scheduler (WP_Cron). If you have, then you have to manually [configure a scheduled system task](https://developer.wordpress.org/plugins/cron/hooking-into-the-system-task-scheduler/) to run your queued cron jobs. Otherwise, neither WordPress nor this plugin will function correctly.

= I’ve changed my mind and what all the IP addresses back. =

If you’ve installed the plugin less than six hours ago, you can just disable it and nothing will have changed.

Otherwise, please restore your data from a database backup made prior to activating the plugin.

== Changelog ==

= 1.0.2 =

* Initial public release.

= 0.9 =

* Here be dragons.

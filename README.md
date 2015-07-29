# JEO Blank

A blank [JEO](https://github.com/oeco/jeo) child theme so you can start your own.

JEO presents plenty of WordPress hooks (actions and filters) and JavaScript events so you can customize your child theme and transform JEO suiting your project needs. Here you will also have some ideas of what you can do.

## Features

 - Deregisters default JEO site CSS
 - Deregisters default JEO site front-end JavaScript
 - Demonstrate most used JEO hooks
 - Demonstrate useful JavaScript events

## Developing

Download this repository and start your own project as a new repository. **Fork this repository only if you have contributions for the JEO Blank itself**.

Make sure you read [WordPress child theme specifications](https://codex.wordpress.org/Child_Themes) so you understand how templates relationship works on between parent and child themes.

## JEO templates

JEO uses templates to visualize some of its features. You can overwrite them by creating the files in your child theme.

**Note** that you can change any page template from JEO theme by creating the files in your child theme, these are the ones the JEO creates so it can run properly, here they are:

### [Marker bubble](https://github.com/oeco/jeo/blob/dev/content-marker-bubble.php)

**`content-marker-bubble.php`**

The content displayed inside the bubble (tooltip) of the marker when mousehovered.

### [Map](https://github.com/oeco/jeo/blob/dev/content-map.php)

**`content-map.php`**

The map itself, displayed when `<?php jeo_map(); ?>` is called.

### [Map group](https://github.com/oeco/jeo/blob/dev/content-map-group.php)

**`content-map-group.php`**

Same idea as `content-map.php` but for the map group.

### [Share a map](https://github.com/oeco/jeo/blob/dev/content-share.php)

**`content-share.php`**

The page for the **Share a map** feature.

### [Embed](https://github.com/oeco/jeo/blob/dev/content-embed.php)

**`content-embed.php`**

The embed output page.

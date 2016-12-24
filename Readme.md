# WikkaWiki Force Action plugin

[![D3](https://github.com/pepitosoft/force/raw/master/images/d3icon.png)](https://d3js.org/)
[![WikkaWiki](https://github.com/oemunoz/Wikka-reveal-handler/raw/master/images/wizard.gif)](http://wikkawiki.org/HomePage)

## What is this?

This is a a action plugin for easily creating WikkaWiki links representation using JavaScript and D3.

![Force Preview](https://github.com/pepitosoft/force/raw/master/images/force_plugin_preview.png)

Easy step:

1. Put this repo on "/plugins/actions/force" directory.

## Why?

Is a very easy way to create and follow links representation with force-d3.

## How?

This plugin works like any action plugin on WikkaWiki:

1. Addind the action like usual:

For example:

```markup
 {{force}}
```

### How install it?

#### Install the handler:

The first is like a simple Action plugin, this meaning that you have to add "/force" directory to actions path:

Drop this repo on your "/plugins/actions/force" directory.

Directory Estructure:

```bash
cd plugins/handlers/
mkdir reveal
git clone https://github.com/oemunoz/Wikka-reveal-handler.git reveal/
```

![Directory estructure](https://github.com/oemunoz/Wikka-reveal-handler/raw/master/images/paths.png)

Edit the follow code near to the end of "libs/Wakka.class.php", backup your original file and the new must be like:

```php
<?php ....
elseif($this->GetHandler() == 'reveal')
{
  print($this->Handler($this->GetHandler()));
}
.... ?>
```

Now, If you completed this, create a new document like this:

~~~~
wikka.php?wakka=slides.md/edit
~~~~

~~~~language-markdown
# Reveal.js
### HTML Presentations Made Easy
![Example Pic](https://github.com/iush/iush.github.io/raw/master/images/bio-photo.jpg)

Created by [Hakim El Hattab][hakim]
----
# First
====
# Column 1, Slide 1
----
# Column 1, Slide 2
----
# Column 1, Slide 3
====
# Middle
====
# Column 2, Slide 1
----
# Column 2, Slide 2
----
# Column 2, Slide 3

----

# Last
# THE END
### BY Hakim El Hattab / hakim.se

[hakim]: http://hakim.se
~~~~

And try to acces with:
~~~~
wikka.php?wakka=slide.md/reveal
~~~~

![Fisr slide](https://github.com/oemunoz/Wikka-reveal-handler/raw/master/images/reveal_fist.png)

## FAQs and TODOs

- We can change the background?

> R: For now, is not, but on the follow release we gonna to allow to upload files with this in mind.

- [ ] TODO: Create uploads directory.
- [ ] TODO: Auto path images on the upload directory.

# Powered by:
- [WikkaWiki](http://wikkawiki.org/HomePage) is a flexible, standards-compliant and lightweight wiki engine written in PHP, which uses MySQL to store pages.
- [RevealJS](https://github.com/hakimel/reveal.js/) is a framework for easily creating beautiful presentations using HTML.

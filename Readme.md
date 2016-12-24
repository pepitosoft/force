# WikkaWiki Force Action plugin

[![D3](https://raw.githubusercontent.com/pepitosoft/force/master/images/d3icon.png)](https://d3js.org/)
[![WikkaWiki](https://github.com/oemunoz/Wikka-reveal-handler/raw/master/images/wizard.gif)](http://wikkawiki.org/HomePage)

## What is this?

This is a a action plugin for easily creating WikkaWiki links representation using JavaScript and D3.

![Force Preview](https://raw.githubusercontent.com/pepitosoft/force/master/images/force_plugin_preview.png)

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
cd plugins/actions
mkdir force
git clone https://github.com/pepitosoft/force.git force/
```

## FAQs and TODOs

- I part of the default plugins of WikkaWiki

> R: For now, is not, but we gonna to try.

- [ ] TODO: Controler for the down level.
- [ ] TODO: Recursive iteration for levels.

# Powered by:
- [WikkaWiki](http://wikkawiki.org/HomePage) is a flexible, standards-compliant and lightweight wiki engine written in PHP, which uses MySQL to store pages.
- [D3](https://d3js.org/)
- [Animating Changes in Force Diagram](http://bl.ocks.org/ericcoopey/6c602d7cb14b25c179a4)

# References:
- [Modifying a Force Layout](http://bl.ocks.org/mbostock/1095795)

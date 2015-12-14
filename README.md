# WP Theme

Boilerplate theme for WordPress sites.

## If using Bourbon/Neat

### Install Bourbon and Neat in current directory:

```
bourbon install
```
```
neat install
```

### Import Neat in your stylesheet, after Bourbon:

```
@import "bourbon/bourbon";
@import "neat/neat";
```

## Install Node Modules

```
npm install
```

## Run gulp
###### Note: node v5.2.0 required

```
gulp
```
#### Browser Sync

##### Paste the following before the closing body tag

```
    <script type='text/javascript' id="__bs_script__">//<![CDATA[
        document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.10.0.js'><\/script>".replace("HOST", location.hostname));
    //]]></script>

```
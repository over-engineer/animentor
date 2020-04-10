<p align="center">
    <img width="128" height="128" src="assets/icon.svg" />
</p>

# Animentor

[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/animentor-lottie-bodymovin-elementor)](https://wordpress.org/plugins/animentor-lottie-bodymovin-elementor/)
[![WordPress Plugin: Tested WP Version](https://img.shields.io/wordpress/plugin/tested/animentor-lottie-bodymovin-elementor)](https://wordpress.org/plugins/animentor-lottie-bodymovin-elementor/)
[![WordPress Plugin Rating](https://img.shields.io/wordpress/plugin/stars/animentor-lottie-bodymovin-elementor)](https://wordpress.org/plugins/animentor-lottie-bodymovin-elementor/)
[![WordPress Plugin Active Installs](https://img.shields.io/wordpress/plugin/installs/animentor-lottie-bodymovin-elementor)](https://wordpress.org/plugins/animentor-lottie-bodymovin-elementor/)

🍭 Lottie & Bodymovin widget for [Elementor](https://wordpress.org/plugins/elementor/).

## Table of Contents

* [Installation](#-installation)
* [Usage](#-usage)
* [Features](#features)
* [FAQ](#-faq)
    * [What is Lottie?](#what-is-lottie)
    * [How to install bodymovin?](#how-to-install-bodymovin)
* [Bugs & Features](#-bugs--features)
* [Credits](#-credits)
* [License](#-license)

## 📦 Installation

### Automatic installation

Automatic installation is the easiest option — WordPress will handle the file transfer, and you won’t need to leave your web browser.

1. Log in to your WordPress dashboard
2. Navigate to the “Plugins” menu
3. Search for “Animentor – Lottie & Bodymovin for Elementor”
4. Click “Install Now” and WordPress will take it from there
5. Activate the plugin through the “Plugins” menu in WordPress

### Manual installation

1. Upload the entire `animentor-lottie-bodymovin-elementor` folder to the `wp-content/plugins/` directory
2. Activate the plugin through the “Plugins” menu in WordPress

## ⌨️ Usage

After [installation and activation](#-installation), you will find the “Lottie” widget under the “General” widgets category of Elementor Page Builder.

## 🎉 Features

- **Intuitive UI**, everything is **configurable directly within Elementor**, through the widget’s controls
- Manage and re-use animation data JSON files through the **WordPress Media Library**
- **Works with the latest version of Elementor** (does not require Elementor Pro)
- Includes several animation options, allowing you to customize:
    - ⏱ The **speed** of the animation
    - ▶️ Whether to **autoplay** on page load
    - ♾ Whether to **loop** or play once
    - ⏪ Whether to **play reversed**
    - 🖱 Whether to **play on mouse over**
    - ⏹⏸⏪ Whether to **stop, pause, or reverse on mouse out**
- Includes several styling options, allowing you to customize:
    - 📏 The **dimensions (width and max width) with responsive controls**
    - 🧰 **Opacity, CSS filters, borders, and box shadow!**

## ❔ FAQ

### What is Lottie?

[Lottie](http://airbnb.io/lottie/) is a mobile library for Web, and iOS that parses [Adobe After Effects](https://www.adobe.com/products/aftereffects.html) animations exported as json with [Bodymovin](http://aescripts.com/bodymovin/) and renders them natively on mobile!

### How to install bodymovin?

Follow one of the options on [lottie-web GitHub repository](https://github.com/airbnb/lottie-web):

#### Option 1 (recommended)

Download it from from [aescripts](http://aescripts.com/bodymovin/).

#### Option 2

Get it from the [Adobe Exchange App Marketplace](https://exchange.adobe.com/creativecloud.details.12557.html).

#### Option 3

- Download the ZIP from the [lottie-web GitHub repository](https://github.com/airbnb/lottie-web).
- Extract its content and get the `.zxp` file from `/build/extension`
- Use the [ZXP installer](http://aescripts.com/learn/zxp-installer/) from aescripts.com.

#### Option 4

- Close After Effects.

- Extract the zipped file on `build/extension/bodymovin.zxp` to the Adobe CEP folder:

    - **Windows:**

        ```
        C:\Program Files (x86)\Common Files\Adobe\CEP\extensions
        ```
        
        or
        
        ```
        C:\<username>\AppData\Roaming\Adobe\CEP\extensions
        ```
    
    - **macOS:**
    
        ```
        /Library/Application\ Support/Adobe/CEP/extensions/bodymovin
        ```
        
        You can open the terminal and type:
        
        ```
        $ cp -R YOURUNZIPEDFOLDERPATH/extension /Library/Application\ Support/Adobe/CEP/extensions/bodymovin
        ```

        Then, to make sure it was copied correctly, type:
        
        ```
        $ ls /Library/Application\ Support/Adobe/CEP/extensions/bodymovin
        ```

- Edit the registry key:

    - **Windows:**

        Open the registry key `HKEY_CURRENT_USER/Software/Adobe/CSXS.6` and add a key named `PlayerDebugMode`, of type String, and value `1`.

    - **macOS:**

        Open the file `~/Library/Preferences/com.adobe.CSXS.6.plist` and add a row with key `PlayerDebugMode`, of type String, and value `1`.

### Option 5

Install the zxp manually following [this guide](https://helpx.adobe.com/x-productkb/global/installingextensionsandaddons.html).

Skip directly to “Install third-party extensions”.

#### Option 6

Install with [Homebrew](http://brew.sh/)-[adobe](https://github.com/danielbayley/homebrew-adobe):

```
$ brew tap danielbayley/adobe
$ brew cask install lottie
```

**After installing**

- **Windows:** Go to Edit > Preferences > Scripting & Expressions... > and check on “Allow Scripts to Write Files and Access Network”
- **macOS:** Go to Adobe After Effects > Preferences > Scripting & Expressions... > and check on “Allow Scripts to Write Files and Access Network”

**Old Versions**

- **Windows:** Go to Edit > Preferences > General > and check on “Allow Scripts to Write Files and Access Network”
- **macOS:** Go to Adobe After Effects > Preferences > General > and check on “Allow Scripts to Write Files and Access Network”

## 🐞 Bugs & Features

If you have spotted any bugs, or would like to request additional features from the plugin, please [file an issue](https://github.com/over-engineer/animentor/issues).

## 📙 Credits

* Plugin developed by [over-engineer](https://over-engineer.com/)
* Plugin icon and banner designed by the amazing [kwnva](https://kwnva.design/)

## 📖 License

Animentor is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Animentor is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Animentor. If not, see <http://www.gnu.org/licenses/>.

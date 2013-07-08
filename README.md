# EM Beer Manager #

*by Erin Morelli*

Manage your beers with WordPress. Integrates simply with Untappd beer checkins. Great for everyone from home brewers to professional breweries!


### Overview ####

This plugin allows beer creators from home brewers to professional breweries to easily manage and display their beers. Includes a comprehensive beer management section with a variety of options, including:

* A custom beer "style" taxonomy for categorizing your beers
* Shortcodes and template tags for displaying all or a select number of beers
* Custom meta boxes to store detailed information about each beer, including abv, ibu, and ingredients
* Simple beer checkin integration with Untappd
* A "Beer List" widget for simply displaying your beers in sidebars
* A "Recent Check-Ins" widget for displaying recent beer check-ins for your brewery on Untappd
* Custom page display for beers and styles

#### Planned Features ####

* Option to add simple age verification check to site
* Additional taxonomy for "availability"

#### Screenshots ####

1. [The "Beer" management screen](https://raw.github.com/ErinMorelli/em-beer-manager/master/screenshot-1.jpg)
2. [Beer profile information](https://raw.github.com/ErinMorelli/em-beer-manager/master/screenshot-2.jpg)
3. [Extra Beer information](https://raw.github.com/ErinMorelli/em-beer-manager/master/screenshot-3.jpg)
4. [Special styles organization](https://raw.github.com/ErinMorelli/em-beer-manager/master/screenshot-4.jpg)
5. [Single beer front-end display (with all options enabled)](https://raw.github.com/ErinMorelli/em-beer-manager/master/screenshot-5.jpg)
6. [Beer List widget options](https://raw.github.com/ErinMorelli/em-beer-manager/master/screenshot-6.jpg)


*****


### Installation ###

1. Unzip the `em-beer-manager.zip` file to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. See below to learn more about usage.


*****

### Usage ###


Use these shortcodes to display beers in your posts or use the template tags in your theme files.


#### Single Beer Display ####

     [beer id={beer id}]

     <?php echo embm_beer_single( [beer id], [show_profile (optional)], [show_extras (optional)] ); ?>

This will display a single beer entry given it's ID number (found in "Beers" admin). Optional attributes for both shortcode and template tag:

* __show_profile={`true/false`}__ (Default = `true`)
     
    *Displays or hides the "Beer Profile" information*

* __show_extras={`true/false`}__ (Default = `true`)
     
    *Displays or hides the "More Information" section*


#### List All Beers ####


     [beer-list]

     <?php echo embm_beer_list( [exclude (optional)], [show_profile (optional)], [show_extras (optional)], [style (optional)] ); ?>
     
This will display a formatted listing of all beers in the database. Optional attributes for both shortcode and template tag:

* __exclude={`"beer ids"`}__ (String separated by commas e.g. `"4,23,24"`)

    *Hides listed beers from output*

* __show_profile={`true/false`}__ (Default = `true`)

    *Displays or hides the "Beer Profile" information for each listing*

* __show_extras={`true/false`}__ (Default = `true`)

    *Displays or hides the "More Information" section for each listing*

* __style={`"style name"`}__ (String e.g. `"India Pale Ale"`)

    *Displays only beers belonging to a specific beer style*

* __beers\_per\_page={`number`}__ (Default = `-1`, shows all beers on one page)

    *Paginates output and displays the given number of beers per page*

*****

### Changelog ###

#### 1.6.0 ####
* Added localization POT
* Added new "Recent Untappd Check-Ins" widget
* Added new settings option for Untappd brewery ID
* Updated settings page with help documentation

#### 1.5 ####
* Added translatable strings for localization
* Added new "Beer List" widget to display a list of beers with a number of display options
* Added themed template files for styles and single beer page display
* Fixed bug that caused plugin activation to throw a header error

#### 1.0 ####
* Initial plugin release

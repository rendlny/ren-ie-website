# spoopy-floofer-website
My personal website that will display my enamel pins for sale / trade and allows people to fill in a form to request a trade or purchase. Possible features: Implementation of a Telegram bot that will notify me of trade request and use my answer to upate the item.  

## Setup
This project requires Nodejs to be installed in order to get some dependencies.

#### Install dependencies
```
npm install
```

#### Install packages
```
composer install
```

#### Config
Create a `config.ini` file in the php directory containing your database connection variables.
```
[database]
db_host     = <host>
db_user     = <user>
db_password = <password>
db_name     = <database name>
```
#### Install Gulp
```
npm install -g gulp-cli
```

## Running the dev server
The project is setup with a default gulp task that will run a local php server and reload the page when any resource is updated. The server is using [php's built in web server](https://www.php.net/manual/en/features.commandline.webserver.php).

**Note:** The default dev server can not make use of the `.htaccess` file for redirects as that is only used by apache.

To run this task simply run the command `gulp`. This will open the index page in your browser at http://localhost:3000/.
**Note:** To install gulp, run the following command `npm install --global gulp-cli`

#### From local apache server
If you are running a local apache server (e.g with XAMPP) and wish to use this instead, you can override this with an environment variable. For example, if you created a virtual host at http://cropreport.local/ that points to this projects root directory, you will need to create a `.env` file in the projects root directory containing the following
```
BROWSER_SYNC_PROXY=cropreport.local
```
Running the `gulp` command now will cause it to skip starting the basic php server and instead proxy the browser-sync requests to the domain specified.

#### Gulp Task
To just compile the Sass files to css run `gulp css`.

#### Website Data
Create a `website_data.ini` file in the php directory containing your website data.
```
[header]
header_icon_img_link = '';
header_title = '';

[navbar]
nav_1_txt = ''
nav_1_link = ''
nav_2_txt = ''
nav_2_link = ''
nav_3_txt = ''
nav_3_link = ''

[sidebar]

[footer]
twitter_link = ''
instagram_link = ''
telegram_link = ''
github_link = ''
copyright_txt = ''

[home page]
home_title = ''
home_txt_1 = '';
home_txt_2 = ''
home_txt_3 = ''

```

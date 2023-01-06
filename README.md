# ren.ie

My personal website that will display my personal projects, coding abilities & more. It will also list my enamel pins for sale / trade and allows people to fill in a form to request a trade or purchase.

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

Duplicate the `config.ini.example` file and name it `config.ini`. Fill in your database connection data.

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

If you are running a local apache server (e.g with XAMPP) and wish to use this instead, you can override this with an environment variable. For example, if you created a virtual host at http://crop-report.local/ that points to this projects root directory, you will need to create a `.env` file in the projects root directory containing the following

```
BROWSER_SYNC_PROXY=crop-report.local
```

Running the `gulp` command now will cause it to skip starting the basic php server and instead proxy the browser-sync requests to the domain specified.

#### Gulp Task

To just compile the Sass files to css run `gulp css`.

#### Website Data

Duplicate the `website_data.ini.example` file and name it `website_data.ini` and fill in your data.

### Docker

This project contains the files required to run as a Docker container.

- docker-compose up -d
- docker-compose exec php composer install
- In phinx.yml set host to host.docker.internal:9906
- In config.ini set db_host to host.docker.internal:9906
- docker-compose exec php vendor/bin/phinx migrate

To run any new migrations

- docker-compose exec php composer phinx migrate

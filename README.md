# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

# DreamLog

DreamLog is a minimal dream journaling web app built with **CodeIgniter 4**.
It allows users to log their dreams, optionally upload images, add tags, and view them on a calendar or a blog-style feed.

---

## Features

* Add dreams with title, content, image, and tags.
* View recent dreams in a grid.
* Explore dreams on an interactive calendar.
* Full dream details page with image, content, and tags.

---

## Setup Guide

### 1. Clone the Project

```bash
git clone https://github.com/your-username/dreamlog.git
cd dreamlog
```

### 2. Setup Environment

Copy the example environment file and configure it:

```bash
cp env .env
```

Then edit `.env` and set your database connection details:

```
database.default.hostname = localhost
database.default.database = dreamlog_db
database.default.username = root
database.default.password = yourpassword
```


### 3. Run Migrations

```bash
php spark migrate
```

This will create the `dreams` table.

### 4. (Optional) Seed Example Dreams

```bash
php spark db:seed DreamSeed
```

This will populate the database with **10 sample dreams** (with images and tags).

---

## Development Server

```bash
php spark serve
```

Visit your app at `http://localhost:8080`.

---

## Folder Structure

* `app/Controllers` — App logic (e.g., DreamController)
* `app/Models` — Database models (DreamModel)
* `app/Views` — Views (home, calendar, create, view)
* `public/uploads` — Uploaded dream images

---

## Tech Stack

* PHP 8+
* CodeIgniter 4
* MySQL / MariaDB
* HTML + CSS + JS (no frontend frameworks)

---

## Commands Summary

| Action              | Command                       |
| ------------------- | ----------------------------- |
| Migrate DB          | `php spark migrate`           |
| Rollback DB         | `php spark migrate:rollback`  |
| Seed Example Dreams | `php spark db:seed DreamSeed` |
| Start Local Server  | `php spark serve`             |



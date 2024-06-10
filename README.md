---

## News Aggregator

## Overview

This project aims to create a system for fetching periodic news articles from multiple sources and displaying them on the front end. It involves fetching and storing news articles from specified sources, creating an API for displaying news with filtering options, and implementing a simple management dashboard.

## Requirements

- PHP >= 7.4
- Composer
- Node.js
- npm or Yarn
- MySQL or any other compatible database

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/rezak9876/interviews-news-aggregator.git
    ```

2. Navigate into the project directory:

    ```bash
    cd interviews-news-aggregator
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Install JavaScript dependencies:

    ```bash
    npm install && npm run dev
    ```

5. Rename the `.env.example` file to `.env` and fill in your database information and add your NEWSAPI_KEY and GUARDIAN_KEY.

6. Generate a new application key:

    ```bash
    php artisan key:generate
    ```

7. Run the migrations to create the database tables:

    ```bash
    php artisan migrate
    ```

## Usage

### Running the Project

To run the project, start the Laravel development server:

```bash
php artisan serve
```

The project will be accessible at `http://localhost:8000`.

### Updating News

#### Manual Update

1. Go to the admin panel (/admin/news).
 (it needs authentication, you can add user from /register route.)
2. Click the "Update News" button.

#### Automatic Update

The project includes a Laravel scheduler that automatically updates the news every hour.
you can also use this command to fetch news.
```bash
php artisan fetch:news
```

### Fetching Filtered News (API)

You can use the API to fetch filtered news based on different criteria such as source, and date. The endpoint for the API is:

```
GET /api/news
```

#### Parameters

- `source`: Filter news articles by source.
- `date`: Filter news articles by date.


in date parameter you can use these values:
- `ge`: greater or equal than
- `g`:  greater than
- `se`:  smaller or equal than
- `s`:  smaller than

Example request:
```
GET /api/news?source=NewsApi&date[ge]=2024-05-10&date[se]=2024-06-10
```
in this example we access the news which source is NewsApi and date is between 2024-05-10 and 2024-06-10.
---

This README provides an overview of the project, installation instructions, usage guidelines, and references to further documentation.
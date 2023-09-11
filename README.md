**Development Notes**

This is a Laravel-based PHP project, so some familiarity is a must.

**Requirements**


1. PHP >= 7.3
2. These PHP extensions enabled: reqs
4. Microsoft SQL Server. You can use docker-based one for development, or use SQL dev instance in 10.199.50.11, see connection string sample.
5. Git
6. Composer

**Initial Setup**
1. Clone source from https://gitlab.com/wahyu.dewantoro/siswades
2. composer check-platform-reqs
3. composer install
4. cp .env.example .env
5. vim .env #configure DB connection string
# Cloudstaff Job Portal API

Job portal  API

## Getting Started

### Prerequisites
* MySQL
* PHP 7.4
* Composer

### Installing
1. `git clone https://github.com/paulolorenzobasilio/cloudstaff-job-portal-api.git`
2. `cp .env.example .env`
3. set your s3 bucket in .env (S3_BUCKET="s3 bucket name")
4. composer install
5. php artisan migrate --seed
6. php artisan db:seed --class=CreateCloudStaffAdminSeeder
7. php artisan db:seed -- class=CreateCloudStaffEmployerSeeder

## Development
1.) Set your S3 ACCES KEY ID (Always set this before serving the application)
```
For linux,
SET AWS_ACCESS_KEY_ID="ACCESS KEY ID"
SET AWS_SECRET_ACCESS_KEY="SECRET ACCESS KEY"

For windows,
export AWS_ACCESS_KEY_ID="ACCESS KEY ID"
export AWS_SECRET_ACCESS_KEY="SECRET ACCESS KEY"
```

2.) Serve the application `php -S localhost:8000 -t public` 

3.) Check your http://localhost:8000

## API Docs
Import the `insomnia_api.json` file to Insomnia client.

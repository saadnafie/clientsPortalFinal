<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.cleansheetgroup.com/wp-content/uploads//2021/10/Final-Logo-1.svg" width="400" alt="Clean Sheet Group Logo"></a></p>

<p align="center">
<h2>Clients Portal</h2>
</p>

## Authors and maintainer
Clean Sheet Group is the original and current author of this client portal.

## About Clients Portal

The Clients Portal is the portal for Clean Sheet Group clients, helping them submit their candidate certificates and licences for our system to be checked and verified. Those make it easier for them to get updated about their application status and be notified whenever any required files are missing in the submitted applications.

The following are some of the tasks that Clean Sheet Group provides through this portal:

- Submitting the candidate's applications to our system to be verified
- Detailed statistics about the status and progress of the application
- The ability to update or delete the application
- A verification history provides all historical information about the application process
- Two different account types (individual and corporate)

## Requirements

- **[PHP >= 8.1.12](https://www.php.net/downloads.php)**
- **[Composer](https://getcomposer.org/download/)**
- **[Node.js >= v16.17.0](https://github.com/npm/cli)**

## Quick Installation
1. Download the repository on your server: 
```
https://github.com/CSGabdalla/ClientsPortal.git
```

2. Run composer to install the required libraries and dependencies:
```
cd ClientsPortal
composer install 
```

3. Run npm to install the frontend dependencies:
```
npm install 
npm run dev
npm run build
```
**Note:** When you run the command *npm run dev*, it might stuck for a long time to be executed. You can stop it and move on to the next command, *npm run build*.

3. Run npm to install the node_modules dependencies:
```
npm install 
npm run dev
npm run build
```

4. Create a database called "clients_portal_v1":
```
 MYSQL -u root -p
 CREATE DATABASE clients_portal_v1;
 USE clients_portal_v1;
 ```
 
 5. Run migration and seeders to generate the database tables and seeders: 
```
php artisan migrate:fresh --seed
```

6. Run the following artisan commands to clear the cache, config, generate a new key, and clear the route cache:
```
php artisan key:generate
php artisan route:cache
php artisan route:clear
php artisan config:cache
php artisan config:clear
php artisan cache:clear
php artisan optimize
```

7. Create a folder "mpdf" inside /storage/app directory to store temporary the LOA pdf file
```
mkdir /storage/app/mpdf
```

8. Add this line inside the /config/Pdf.php file:
```
'tempDir' => base_path('storage/app/mpdf'),
```

9. Give the storage, bootstrap, and public directories permission to be accessed: 
```
sudo chown -R www-data:www-data /var/www/html/ClientsPortal/storage
sudo chown -R www-data:www-data /var/www/html/ClientsPortal/bootstrap
sudo chown -R www-data:www-data /var/www/html/ClientsPortal/public/
sudo chown -R $USER:$USER /var/www/html/ClientsPortal/public/
```

10. Insert the cron task inside the cron file inside your server: 
```
# open cron file
crontab -e

# Insert the cron task scheduling command
* * * * * cd /path_to_your_Client_Portal_folder && php artisan schedule:run >> /dev/null 2>&1
```
**Note:** if you are using localhost, you can simply use the command *php artisan schedule:run* to run the schedule tasks.


<h4> Congratulations! Your application is ready to be used. </h4>


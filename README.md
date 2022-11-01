## Exchange App

This site helps people to receive up-to-date information on changes in currency exchange rates. 

The application can be used in two different role: there is one administrator and there could be many users. 

# 

## Usage

### Database settings:

In default the app uses a mysql database running at the port 3306 with the name "exchangeApp", with "root" username and without password. You can change these default settings in the .env file. 

### Seeding:

After configuring the database, if you run the 

#### php artisan db:seed 

command, the system creates automatically an admin account with the "admin@admin.com" email address and "password" password. It also creates 20 users with random generated email adresses and "password" password (you can view these email addresses at the Users option). 

This command also inserts the banks into the database. 

### Start the app:

#### php artisan serve

#### npm start dev

#

### Downloading the new exchange rates:

If you run the 

#### php artisan queue:work 

artisan command, the system will download every day the daily exchange rates of the banks introduced in the system (European Central Bank - ECB, Romanian National Bank - BNR, Narodowy Bank Polski - NBP, Bank of Canada - BOC). 

If you would like to save it manually, you can do it with the following artisan command:

### php artisan download rates --bank=<bank> -- type=<type>
 (to the type you can write:
 - day : if you want to save the last published rates
 - all : if you want to save the whole history of the exhange rates )

### Website:

- on the MAIN PAGE you can see the daily exchange rates published by the banks introduced in the system
- you can REGISTER or LOGIN

Logging in as a NORMAL USER, you can:
- see the active banks, you can choose one of them and see the whole history of the exchange rates published by it
- calculate exchanges of a specific amount of money between two currencies (CALCULATOR option)
- sign up to be notified when the rate between two certain currencies reaches a set level (SUBSCRIBE option)
- see your subscriptions (SUBSCRIPTION option)

In addition to these, an ADMIN can:
- deactivate/activate a bank (BANKS option)
- watch the registered users' list (USERS option)
- watch every user's descriptions and is able to delete them (SUBSCRIPTION option)



### API: 

This app has an API part where you can do the same thing as on the user interface, and in plus delete the saved data into the database related to the banks. (see the routes in the routes/api.php file)


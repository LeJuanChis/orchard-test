# Orchard PHP Developer Test
This project is designed to show the two points of the Orchard technical interview. This project uses:

- Drupal 11.1
- PHP 8.1 or higher
- Database: mariadb 10.11

# Prerequisites
- PHP 8.1 or higher
- Composer installed on the system
- ddev and docker installed on the system (this project uses DDeV as a development environment, however, you can use the one that best suits you according to your criteria)

# Installation and Configuration

(In the next steps i will show how to install and configure the project using ddev, you can use any local environment that you want)
- Clone the repository in your local environment: 
git clone https://github.com/LeJuanChis/orchard-test.git

- Start the development environment using ddev:
We stand at the root of the project and execute: ddev start

- Download the required files using Composer:
ddev composer install or composer install

- Import the database file called "local.sql.gz":
ddev import-db
And then copy and paste the file url

- Clear cache:
ddev drush cr

- Access to the administration page with drush:
ddev drush uli
And then copy and paste the given url in the browser


Once we have the project installed and the database imported, we can proceed to view task 1 specified in the document:
# Task 1

To test task number one, you can enter the node called "Test" from the content section, there we can see a menu with the title "Menu link" and we can see the functionality.
If you want to change the order of the menu items you can access the section "Structure" and then "Menus" where you can find a menu called "Menu link" which we will give in the button "edit menu" and there you can change the order of the items

# Task 2
To test the task number 2 you can enter the section "Content" and there you can see all the products that exist, you can create one, edit an existing one or delete it. In the "Products" section you have a list with all the products created. When you create a product you have a field called "Product of the day", if you check it then this product will be part of task 2. You can see that it does not allow to create more than 5 products with this flag checked at the same time.
You can enter the node called "test 2" from the content section, there you will find the functionality.

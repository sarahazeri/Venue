# Venues

A list of venues and sorting them in new way

1.Clone Project
2.Create a Database using the name "venue_wise", or it can be customized by editing the .env file
3.Open the project folder, then open the terminal / cmd and type the command "composer update"
4.Open the database folder => seeders => DatabaseSeeder.php then edit the username and password according to taste
5.Open the terminal / cmd and type the command "php artisan migrate:fresh --seed"

Description:
In the left menu, you can see the list of with normal sorting by clicking on the "CRUD" options.
By clicking on "Venues", the list of venues will be displayed in normal order.
But after selecting the categories from the top of the page, the list of venues will be displayed based on the selected
category.
If you want to return to the default mode, you can click on the "Reset Filters" button.

I had two solutions
1- Add a weight column to each of the propertytypes, venuetypes, and events tables ,...
2- Define a weights table and store all weights in it.
Each of the methods had advantages and disadvantages. After searching and checking, I finally came to the conclusion to
use the second method for your training

Note:I used the AdminLTE to have some default css and javascript

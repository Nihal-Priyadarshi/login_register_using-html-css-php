# login_register_using-html-css-php

#### This is a login and register file created using php, it allows you to login first and then register/add admin on localhost only. if you are not using localhost then change server, username and password in config.php file.

### Create a databese named "login" and then create a table named "users" in it.

##### users -> there are 4 column i) id ii) username iii) password iv) created_at
##### id with auto-increment, type -> int, length -> 4
##### username, type -> varchar, length -> 50
##### password, type -> varchar, length -> 255
##### created_at, type -> datetime, default -> current_timestamp()

#### After creating table, you must have to manually insert a row in the table for login first time with username and password but remember that hashed value of passwords are stored in table instead of original passwords.

#### So, let me help you with first login id and password -->


### Insert Value in table

#### leave id blank, username -> demo1, password -> $2y$10$LDUZ3BaLE9a8GI6ULb1WoOLJFMFvXh/w/piZlNWR5WQevztxVlbtS, leave created_at blank. Now click on go, you just created a login credential.

#### Above hashed password cannot be used for login, so use "demo1123"

#### username -> demo1
#### password -> demo1123


### If you don't want to use this above login credential and want your own, then first do as stated above and log in into the system, then click on add admin and register, after successful registration go to database and copy username and hashed password and delete the table for a fresh start, now create a new table and insert first row using your new username and hashed password, and login with new credential, remember you have to login only with username and password and not with hashed password.

### Enjoy Coding!

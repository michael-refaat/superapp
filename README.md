superapp
========

Console application to get a cart of products and print invoice, built with **Laravel Zero Framework**, **Pest Framework**, and **SQLite**

Technical Choices
-----------------

* **PHP**
* **Laravel Zero** (micro-framework to develop a console app)
* **Pest** (PHP testing framework - abstraction on top of PHPUnit)


Run
---

* **composer install**

* e.g. **php superapp createCart --product='T-shirt' --product='Blouse' --product='Pants' --product='Shoes' --product='Jacket'**

* **./vendor/bin/pest** to run tests


Notes
-----

* The persistent layer is an **embedded** SQLite database, in development I used a seeder to seed the database: but since the app is now configured to be in production mode, we cannot run db:seed command to seed an empty db, so I embedded a SQLite database which is already seeded in development. I think that this solution(an embedded db) is just fine for the project needs; however, If I was to spend additional time on the project, I would try to work with an in-memory storage like **Redis**.

* There is a service layer(InvoiceService) between persistent and command layers, and its role is **just to calculate** and build the invoice, so I think that there is no need to go with dependency injection, only need to create a service object to access the only non-static method in the service class. I think also it could be a static method since we don't really need to instantiate the class (or chaining methods) and that would be better for memory; however, in our project one object will not affect the memory in a bad way.

* I was wondring if I could modularize the offers validations logic, like finding a pattern or a structure for an offer type maybe!


Left Out
--------

If I was to spend additional time on the project, I might:

* modularize offers logic
* try to work with in-memory storage
* enhance commenting

Meredith Adaman tutorial
==========================
2016-01-04


Tutorial for implementing Meredith plugin.



Hello
-----------

In this tutorial, I give you a technique I use to create a basic crud system 
using the [datatables plugin](http://datatables.net/) for jquery.


We will create an application with 3 simple pages:

- home
- add user 
- users list

It looks like this (no need to say design was not my priority):

![meredith adaman home](http://s19.postimg.org/952kgx8f7/meredith_adaman_home.png)
![meredith adaman form](http://s19.postimg.org/xx26o5plv/meredith_adaman_form.png)
![meredith adaman list](http://s19.postimg.org/bno9hlu5f/meredith_adaman_list.png)



Features
--------------

The application created with this tutorial has the following features:
 

- CRUD: create, update, read (display the list), delete 
- js validation is handled
- every single bit is customizable
- contextual menu on each row to update/delete
- can hide/show the columns of the table by default (feature from datatables)
- can delete multiple rows at once
- use the pagination, sorting and searching systems from datatables 
- use the server side processing strategy from datatables 
- demonstrates the customization of specific columns rendering (active is turned into a red/green button rather than a 0/1 number)  




Audience
-----------

A php developer who wants to implement a crud strategy using jquery datatables plugin.

 

How to 
----------

The application that we will create is called adaman (no particular reason).

I will use the following technologies (adapt for your needs):


- [php](http://php.net/) 5.6.12 
- [mysql](https://www.mysql.com/) 5.6.25
- [apache http server](https://httpd.apache.org/) 2.2.31
- [jquery](https://jquery.com/) 2.1.4
- [jquery validation plugin](http://jqueryvalidation.org/) 1.14.0
- [jquery datatables plugin](http://datatables.net/) 1.10.10
- [formatter.js](http://firstopinion.github.io/formatter.js/) 0.1.5
- [tim functions](https://github.com/lingtalfi/Tim) 1.1.0
- [switchery](https://github.com/abpetkov/switchery) 0.8.1
- [jquery serialize object](https://github.com/macek/jquery-serialize-object) 2.5.0
- [meredith plugin](https://github.com/lingtalfi/Meredith) 1.0.0
- [boostrap](http://getbootstrap.com/) 3.3.6
- [bootbox](http://bootboxjs.com/) 4.4.0
- [icomoon](https://icomoon.io)
- [universe snapshot](https://github.com/karayabin/universe-snapshot) 2016-01-02
- an internet connection (for assets like jquery, datatables, etc...)



So let's get started

- Download the tarball corresponding to this project
- Let [*] be the root of the folder that you extract from the downloaded tarball of this project 
- Copy paste the [*]/app folder into your app
- Create a virtual host, with serverName = adaman  
- Turn the apache rewrite module on if it's not already  
- Create a database named adaman, then use the [*]/_private/users.sql file to create the structure with the data that we need
- Restart apache and point your browser to http://adaman
- That should be it!




### Security Note

The code is currently vulnerable to cross site scripting: if a user requests a service passing another id, 
she can updates data of other people with same privileges.
        
A possible fix is to add a field in the form which value is stored in session, and check that value on the server side.
        
        

        
        
More info 
=============
 
 
The structure
----------------

The structure for [*]/app is the following
 
.
├── functions
│   └── az.php
├── init.php
├── pages
│   ├── default.php
│   ├── inc
│   │   └── baselist.php
│   ├── meredith
│   │   ├── list-init.php
│   │   ├── main-controllers
│   │   │   └── users.php
│   │   ├── on-modal-open-after
│   │   │   └── users.js
│   │   └── validator-user-code
│   │       └── validatorRules
│   │           └── users.js
│   ├── users-form.php
│   └── users-list.php
├── planets
│   ├── Bat:
│   ├── BumbleBee:
│   ├── CopyDir:
│   ├── Meredith:
│   ├── QuickPdo:
│   ├── Tim:
│   └── Tiphaine:
└── www
    ├── css
    │   └── my_style.css
    ├── index.php
    ├── js
    │   └── pages
    │       └── users.js
    └── libs
        ├── icomoon
        │   ├── fonts
        │   │   ├── icomoon.eot
        │   │   ├── icomoon.svg
        │   │   ├── icomoon.ttf
        │   │   └── icomoon.woff
        │   └── style.css
        └── meredith
            ├── css
            │   └── meredith.style.css
            ├── js
            │   ├── meredith-config.js
            │   └── meredith.js
            └── service
                ├── datatables_server_side_processor.php
                ├── delete_rows.php
                ├── fetch_row.php
                └── insert_update_row.php
 
 

What you need to change?
--------------------------

Let [app] be equivalent for [*]/app.


Let's say you want to extend this crud system for a new table named products, with the following structure:

products:

- id: auto-increment primary
- the_name: varchar 255
- active: char 2


Then, you need to do the following steps.


### Step 1: create the products table in the database

Create the products table, and add some products in it.


### Step 2: add the two links

Add the two links: open [app]/www/index.php and create two new links below the two existing links (around line 73):

```html
<a href="/users-form">Add product</a><br>
<a href="/users-list">Product list</a>
```


### Step 3: Route the links to physical pages


Then you want to route the new links to the pages.
While [app]/www/index.php is open, go to the pseudo routing mechanism (around line 81),
and add two new entries to the $uri2FormId array:


```php
$uri2FormId = [
    '/users-form' => 'users',
    '/users-list' => 'users',
    '/products-form' => 'products',
    '/products-list' => 'products',
];
```

Note that for the sake of simplicity:

- our router maps an uri to a physical (file system) page (if you have more complex needs, just change the router) 
- there is a direct correlation between the uri and the physical page (but of course you can break this correlation whenever you need) 
- the formId is the actual table name (again, you might have more complex needs)

 
### Step 4: Create the physical pages
 
Now we need to create the pages corresponding to those uris:
                
- [app]/pages/products-form.php  (copy paste rename [app]/pages/users-form.php)        
- [app]/pages/products-list.php  (copy paste rename [app]/pages/users-list.php)    
        

### Step 5: Configure the physical pages

Now it's time to configure the physical pages.

Open [app]/pages/products-form.php and change the title (h1) to "Add product".

Similarly, open the [app]/pages/products-list.php file, and where it says:

```php
$formId = "users";
```

change it to:
 
 ```php
 $formId = "products";
 ```
 
 
### Step 6: Configuring the main controller 

Until now, we've just made cosmetic changes, let's now dive more into the Meredith plugin.
Copy-rename the [app]/pages/meredith/main-controllers/users.php file to
[app]/pages/meredith/main-controllers/products.php.

Open it.
That's the main configuration of a meredith table, the real difference between a 
table (or view to be more precise) and another.

We can see that there is a lot of objects that are bound together.
I don't want to go into the details now (open the source code if you are interested),
but we basically have four areas to update:

Around line 24, where is says:

```php
AuthorListHandler::create()
            ->addColumn('id')
            // ...
```

Put your own columns:

```php
AuthorListHandler::create()
            ->addColumn('id')
            ->addColumn('the_name')
            ->addColumn('active')
            ->addColumn('actions', false) // false here means that this column has no content from the database (it is generated by the datatables plugin)
```


Basically, these lines control the jquery datatables plugin.

Now in the next couple of lines, we have the line that says:

```php
->setContentTransformer('active', ActiveInactiveContentTransformer::create())
```

It turns out that we have an active column too in our products table, so we can just keep it,
it will transform the default active value (probably 0 or 1) to a more fancy red-green button.
Comment it to see the difference.


Now the datatables can display correctly.
Let's continue to edit our (main configuration) file.

What we want now is point to http://adaman/products-form and have the relevant form displayed.

Find the area around line 36 where it says:

```php
BootstrapControlsRenderer::create()
                            ->addControl(InputControl::create()->setName("email")->setLabel("Email")->setType("email")->setPlaceHolder("Enter a valid email address"))
```

Replace it with your columns:


```php
BootstrapControlsRenderer::create()
                            ->addControl(InputControl::create()->setName("the_name")->setLabel("Name")->setType("text")->setPlaceHolder("Enter a valid name"))
                            ->addControl(MonoStatusControl::create()->setName("active")->setLabel("Active"))
```


At this point, the form might be displayed correctly, however, the processing of the form 
is not yet configured (i.e., if we post the form we will have weird error messages).

So, let's continue the configuration.
The last area to modify is around line 47, where is says:

```php
FormDataProcessor::create()
    ->addField('id', true, true)
    // ...
```

Replace with your data:

```php
FormDataProcessor::create()
    ->addField('id', true, true)
    ->addField('the_name', false, false)
    ->addField('active', false, false, 0)
```

Ok. So now, we're all good. 
Test your application, and enjoy.


   
   
A couple of notes before you dive into the code
--------------------------------------------------


### Js validation

Before you hack the code, let me provide you with a couple of pragmatic tips:

- if you need to add js validation rules, copy paste the [app]/pages/meredith/validator-user-code/validatorRules/users.js,

and rename it with your formId:

- [app]/pages/meredith/validator-user-code/validatorRules/$formId.js

By default, this technique uses the [jquery validation plugin](http://jqueryvalidation.org/), which is really good.



### Customizing the ajax form's behaviour


The ajax form is the form that opens when the user clicks the edit button at the end of the row,
so it's an update form, which is prefilled.

If you need to do some tweaking just after the form pops up, copy paste adapt 
the [app]/pages/meredith/on-modal-open-after/users.js file, and rename it with the appropriate $formId,
[app]/pages/meredith/on-modal-open-after/$formId.js.


I had the case where my form contained a password and a password confirm, and when I clicked the edit button,
all form controls were prefilled, except the password confirm field (this is the expected behaviour, 
since in the database there is no password confirm field).

So my idea was to add some javascript once the ajax form is loaded, to copy the password value to 
the password confirm field.


 


    
    
    
    



















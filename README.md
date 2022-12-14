# project-verve
A simple &amp; powerful project development system

![Project Verve Overview](https://i.imgur.com/z2xxIEj.png "Project verve overview")

Project verve is a framework for project development simplicity. It helps developer speed up the rate at which they need to design a platform. Project verve contains only Bootstrap, JQuery and FontAwesome making it a light easy to manage framework.

### Project Initialization

- Create a new folder - ```els-content/your-project```
- Create an index file - ```els-content/your-project/index.php```
- In the index file, you can write your code, include other file, install larger libraries etc... to develop your project

### Basic Usage

By default, all request are sent to the root "/index.php" and will always return a 404 Error.

![PV 404](https://i.imgur.com/lGqc4mh.png "Project Verve 404 Display")

For example, your domain is www.domain.com, when a person visits www.domain.com, a 404 error will be displayed because you have not registered the ```home``` page.

Similarly, if a person visits another page like www.domain.com/account, same 404 error will be displayed because you have not registered the ```account``` page.

To register a page, you must create a ```new stdClass()``` instance, assign some properties to it, and pass it to ```Temp::register``` method. 

#### Example - www.domain.com

```php
<?php 

$homepage = new stdClass();

$homepage->content = function() {
	echo 'welcome to the homepage';
};

Temp::register(null, $homepage);
```

Now if you write the above code into the ```index.php``` file of your project directory, whenever www.domain.com is visited, you will see ***"Welcome to the homepage".***

#### Example - www.domain.com/account

```php
<?php 

$accountpage = new stdClass();

$accountpage->content = function() {
	echo "<h3 class='text-center fw-bold'>You must contact the admin to register</h3>"
};

Temp::register("account", $accountpage);
```

Now if your write the above code into the ```index.php``` file of your project directory, whenever www.domain.com/account is visited, you will see a bold text saying ***"You must contact the admin to register".***


The navigation bar and sidebar will all be present.\
But if you don't want them, you can set more option to the stdClass instance.

#### Example - www.domain.com/admin/login

```php
<?php 

$adminLogin = new stdClass();

$adminLogin->blank = true;

$adminLogin->content = function() {
	include 'login-codes.html';
}

Temp::register("admin/login", $adminLogin);
```

The above will be a blank page containing whatever is in the ```login-codes.html``` file

#### Example - www.domain.com/account/fullpage/notification

```php
<?php

$fullpage = new stdClass();

$fullpage->sidebar = false;

Temp::register("account/fullpage/notification", $fullpage);
```

When a user visit the above registered page, it will display a fullpage without sidebar (and also without content since no ```function``` was assigned to ```$fullpage->content```)


## CheatSheets

##### Add an item to the menu

```php
<?php

$Menu->add("menukey", array(
	"label" => "Account",
	"link" => core::url() . '/account'
));
```

##### Add a submenu item to the menu

```php
<?php

$Menu->add_submenu("menukey", "submenu-1", array(
	"label" => "Register",
	"link" => core::url() . '/register'
));

$Menu->add_submenu("menukey", "submenu-2", array(
	"label" => "Login",
	"link" => core::url() . '/login',
	"active" => true // To select this menu
));
```

The easiest way to make a menu active base on the current URL is to use the code: 
```active => (core::slug() == 'login')``` 
So if the REQUEST URI is www.domain.com/login, then the login menu item will be active.

##### Add a script before &lt;/head&gt; tag

```php
<?php

events::addListener("@header:end", function() {
	echo "<link rel='stylesheet' href='your-custom-style.css'>";
});
```

##### Add a script at footer

```php
<?php

events::addListener("@footer:end", function() {
	echo "<script type='text/javascript' src='your-custom-script.js'></script>";
});
```

##### Add content to sidebar

```php
<?php

events::addListener("@sidebar", function() {
	echo "Please Advertise Here!";
});
```

##### Show a banner at the top of every page before content

```php
<?php

events::addListener("/content:before", function() {
	echo "This is a 320 x 250 banner";
});
```

##### Get the REQUEST_URI after Domain Name

```php
// www.domain.com/request-uri/name

<?php
echo core::slug(); // request-uri/name
```

##### Convert SERVER PATH to URL PATH

```php
// C:/your/root-directory/public-html/the-content/image.jpg

<?php
echo core::url( __DIR__ . '/image.jpg' ); // https://the-content/image.jpg
```


### PROJECT REAL-LIFE SAMPLE

***A VIDEO SHARING SYSTEM DESIGNED WITH PROJECT VERVE***

![Project Verve Vidi](https://i.imgur.com/uS1CcjJ.png)

___

![Project Verve Vidi Admin](https://i.imgur.com/XnSjn2z.png)

___


### Need an advance user management system?

Try [User Synthetics](https://github.com/ucscode/user-synthetics "A Profession User Management System")


## AUTHOR

***UCHENNA AJAH (UCSCODE)***

## DONATE

*If you appreciate this project, donate some cryptocurrency to the developer*

**BTC:** 3KPCPLvqarpRdpYyNUKzExsFwdzeprhK7B

**ETH:** 0xa873A81f63C6D4FD976C601dEB75b59c3Cb94fac

## FOLLOW ON

[Facebook](https://facebook.com/ucscode)

[YouTube](https://www.youtube.com/channel/UCPlGBkdI0ydlgAZWoLdmOFg)







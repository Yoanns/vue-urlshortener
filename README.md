# URL Shortener

## About the application

This project consists of building a website that functions as a URL Shortener. The principle of a URL shortener is to reduces the length of any link to chain of characters, but still have that string redirecting to the original link. The criteria for the current application are as follow:
	- A user should be able to load the index page of your site and be presented with an input field where they can enter a URL.
	- Upon entering the URL, a "shortened" version of that url is created and shown to the user.
	- When visiting that "shortened" version of the URL, the user is redirected to the original URL.
	- Additionally, if a URL has already been shortened by the system, and it is entered a second time, the first shortened URL should be given back to the user.

For example, if I enter `http://google.com/` into the input field, and I'm running the app locally on port 8000, I'd expect to be given back a URL that looked something like `http://localhost:8000/1`. Then when I visit `http://localhost:8000/1`, I am redirected to `http://google.com/`.

The sections below describe the steps that lead to the final application.


## How to use

Clone the repository with git clone
Copy .env.example file to .env and edit database credentials there
Run composer install
Run php artisan key:generate
Run npm install
Run npm run dev


## Implemention of the key functionalities

### Requirements
	The technologies needed for this website are:
		- Laravel
		- Composer
		- PHP 7.4
		- Bootstap
		- Vue.js
		- Vue Test Utils
		- Jest
		- Vue-Jest
		- Babel-Jest
		- Axios vform


### Creation of the project with composer
``` composer create-project --prefer-dist laravel/laravel urlshortener```
And run ``` npm install ``` to create the dependencies.
Run also ``` npm install vue-router ``` to add that package to the project.

### Configuration of Vue-Router
Define the skeleton of the application in the `resources/js/app.js` file and define a vue in the `resources/js/views` folder, FormUrl.vue, that shows the form that reads the URL to shorten and displays the shortened link.

### Setup of the database

- [X] Creation of a model to store the URL and a migration for it
 ```php artisan make:model Link -m```

- [X] Addition of 2 fields (original_link and short_link) to the :
	 - newly creation migration file under database/migration
	```
	 public function up()
	    {
	        Schema::create('links', function (Blueprint $table) {
	            $table->id();
	            $table->string('original_link');
	            $table->string('short_link);
	            $table->timestamps();
	        });
	    }
	    ```

	- model (Link) file
		```
		class Urls extends Model
			{
			    /**
			     * The attributes that are mass assignable.
			     *
			     * @var array
			     */
			    protected $fillable = [
			        'original_link,
			        'short_link'
			    ];
			}
			```

- [X] Setting up the MySQL Database
	a- Create the MySQL Database
		```mysql -u root -p```
		enter your password when prompted
		create database urlshortener;

	b- Create a new user
		```
		CREATE USER 'admin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'secret';
		```

	c-grant permission to the new user to access new database
		```
		GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, DROP, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON urlshortener.* TO 'admin'@'localhost';
		```

- [X] Update .env and set the database credentials
	 ```
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=urlshortener
	DB_USERNAME=admin
	DB_PASSWORD=secret
	```

- [X] Run ```php artisan migrate``` for the changes to be taken into account


### Routes

In Laravel 8, the following instruction is commented in the App/Providers/RouteServiceProvider.php file. When the site is launched, it throws the error "Target class [LinkController] does not exist". The commented line should then be uncommented to solve the issue.

In the routes/api.php file, 
	- create a route named `index` that links to the index method in the LinkController
	``` Route::get('/','LinkController@index'); ```

	- create a route named `shorten` that routes to the function that shorthen URLs:
	``` Route::post('/shorten','LinkController@shorten'); ```

	- create a route named 'fetchURL' that redirects the short link to the actual URL:
	``` Route::post('/{link}','LinkController@fetchURL'); ```

### Controller

 The next step is to create a controller (LinkController) where the methods declared in the routes/api.php are defined.

 ``` php artisan make:controller LinkController ```

 The created controller is located at `App/Http/Controllers/LinkController.php`.

 The index function is created afterwards in the `App/Http/Controllers/LinkController.php` to display the main page.

The next step is to create the form that will process the links. this is done in the file `resources/views/welcome.blade.php`.


## Styling

Bootstrap is used for the style of the application. Also, the image used is an SVG file from `https://undraw.co`.


## Testing

Two types of tests have been made: 
	- tests of the backend with PHPUnit (already included in Laravel). 
	- tests of the frontend with Vue Test Utils and Jest.

As an application can never be tested enough, the tests created in this project are just a preview of the types of tests that can be implemented and the way to implement them.

### Backend
The command `php artisan make:test Homepage` has been used to create a test file for the application. The file is located under `tests/Feature`.

### Frontend
1. Install Jest and its dependencies : 
 	`npm i -D jest vue-jest babel-jest`
2. Install Vue Test Utils and vue-jest to process Single-File Components :
	`npm install --save-dev @vue/test-utils`
3. Configure Jest by adding the following in the `package.json` file:
	```
    "jest": {
    	"moduleNameMapper": {
		    "^vue$": "vue/dist/vue.common.js"
		  },
        "moduleFileExtensions": [
	        "js",
	        "json",
	        "vue"
        ],
        "transform": {
	        "^.+\\.js$": "<rootDir>/node_modules/babel-jest",
	        ".*\\.(vue)$": "<rootDir>/node_modules/vue-jest"
        }
    }
	```
and also `"test": "jest",` inside the scripts section of the same file.

4. 2 test files (App.test.js and FormURL.test.js) are created under the `tests/` folder. With the 4 tests created 3 should pass and 1 should fail.

5. The tests are run with the command `npm test`.


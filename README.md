<p>
<a href="https://packagist.org/packages/alexmilde/laravel-database-scaffolder"><img src="https://poser.pugx.org/alexmilde/laravel-database-scaffolder/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/alexmilde/laravel-database-scaffolder"><img src="https://poser.pugx.org/alexmilde/laravel-database-scaffolder/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/alexmilde/laravel-database-scaffolder"><img src="https://poser.pugx.org/alexmilde/laravel-database-scaffolder/license.svg" alt="License"></a>
</p>

## About

Ever thought "Maybe someone else needed the same database table layout as i do?"

This package might help you.

### Installation

```
composer require "alexmilde/laravel-database-scaffolder"
```

Artisan Commands:

```
// Copy templates and configurations
php artisan vendor:publish --tag=scaffolder

// Create opengraphs table based on config
php artisan scaffold:migration opengraphs
```

Will generate migration: 

```
...

public function up()
{
    Schema::create('opengraphs', function (Blueprint $table) {
        $table->id();

        $table->string('title', 255);
        $table->string('description', 512);
        $table->string('type', 100);
        $table->string('url', 255);
        $table->string('image', 255);
        $table->string('image-secure_url', 255);

        $table->timestamps();
    });
}

...

```


### Out of the box scaffolds

- [opengraph basic](https://github.com/shweshi/OpenGraph) / [config.json](https://github.com/alexmilde/laravel-database-scaffolder/blob/v0.1/src/Scaffolds/opengraphs.json)



##### I'm more than happy to add your scaffold config request.

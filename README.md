# World Universities Bundle
Symfony ChoiceType listing the world's universities

[![StyleCI](https://styleci.io/repos/88747038/shield?branch=master)](https://styleci.io/repos/88747038)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/foaly-nr1/WorldUniversitiesBundle/master/LICENSE)

## Installation
### Download the Bundle
Open a command console, enter your project directory and execute the following command to download the latest version of this bundle:

``` bash
$ composer require fourlabs/world-universities-bundle
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

### Enable the Bundle

Then, enable the bundle by adding the following line in the *app/AppKernel.php* file of your project:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FL\WorldUniversitiesBundle\FlWorldUniversitiesBundle(),
    );
}
```

## Usage

##### Example

``` php
$builder->add('university', WorldUniversitiesType::class, [
    'required' => true,
]);
```

### Configuration

Example of configuration in `app/config.yml`:

```yaml
fl_world_universities:
    path: "%kernel.root_dir%/Resources/WorldUniversities"
    source: "https://raw.githubusercontent.com/endSly/world-universities-csv/master/world-universities.csv"
```

### Download / update list of universities

```bash
php bin/console fl:world-universities:update
```

## License

[MIT](LICENSE)


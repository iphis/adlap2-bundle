[![Build Status](https://travis-ci.org/iphis/adlap2-bundle.svg?branch=master)](https://travis-ci.org/iphis/adlap2-bundle)

Installation
============

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require iphis/adldap2-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require iphis/adldap2-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    IPHIS\Adldap2Bundle\IphisAdldap2Bundle::class => ['all' => true],
];
```

### Step 3: Configure the bundle

You need to configure your connection. The parameters are the same that use
 [Adldap2](https://github.com/Adldap2/Adldap2/blob/v10.1.1/docs/setup.md).
 
This is a sample configuration that you need to add in the `app/config/adldap2.yml` file:

```yaml
adldap2:
    default:
        hosts: ['corp-dc1.corp.acme.org', 'corp-dc2.corp.acme.org']
        base_dn: 'dc=corp,dc=acme,dc=org'
        username: "admin"
        password: "password"
        auto_connect: true
        schema: Adldap\Schemas\ActiveDirectory::class
        account_prefix: "ACME-"
        account_suffix: "@acme.org"
        port: 389
        follow_referrals: false
        use_ssl: false
        use_tls: false
        version: 3
        timeout: 5
```

You don't need to configure all values. See the original adldap2 documentation for more information.

**_Note:_** `auto_connect` configuration option is not part of the adldap2 library but instead an option for this bundle 
 to configure whether you want the 'adldap2' service to automatically connect on application boot or not.
 
### Step 4: Profit!

A new service called 'adldap2' has been created. It's a configured instance of [Adldap](https://github.com/Adldap2/Adldap2/blob/v7.0/src/Adldap.php)
 class. You can use it as usual:
 
```yaml

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->get('adldap2')->search()->find('username');
    }
}
```

**_Note:_** if you have `auto_connect: false` in your adldap2 configuration you will need to manually call `connect()` 
 before you can perform any queries on the library. 
 
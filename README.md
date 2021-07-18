# cakephp-4-paymob
# paymob
paymob payment gateway https://paymob.com


## Installation
```bash
composer require ahmedebead/cakephp-4-paymob
```
## Usage In CakePhp
    
Add this to file /src/Application.php

```php
    public function bootstrap(): void
    {
        $this->addPlugin('CakeRestApi', ['bootstrap' => true]);
        
        // Other code
    }
```
Or, you can load the plugin using the shell command

```php
   $ bin/cake plugin load CakeRestApi
```

## Usage

```html
<iframe width="100%" height="800" src="https://accept.paymob.com/api/acceptance/iframes/your_iframe_id?payment_token={{$token}}"> 
```


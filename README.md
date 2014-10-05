# Namecheap SDK for PHP

Un-official *(and incomplete)* library to consume the Namecheap API.

**DISCLAIMER: USE AT YOUR OWN RISK**

```
$nc = new \Namecheap\Client(
    'apiuser', // namecheap api user
    'apikey', // namecheap api key
    'username', // namecheap username
    '127.0.0.1', // server ip
    true, // use sandbox, false for live
);

$nc->domains()->check(['DomainList' => 'github.com']);
$nc->domains()->check(['DomainList' => 'google.com,yahoo.com,msn.com']);
$nc->domains()->getTldList();
$nc->domains()->getInfo(['DomainName' => 'github.com']); // must be user's owned domain
```

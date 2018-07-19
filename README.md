# silverstripe-http2
Adds basic HTTP2 functionality like requirements push 

This module adds the necessary HTTP headers to SilverStripe to enable HTTP/2 push functionality on servers which support it.
By default, the module will send the header containing all the CSS and JS files which have been added to a site using the `Requirements` API.


# Requirements
*Silverstripe 4.x

# Installation
Install with `composer require dorsetdigital/silverstripe-http2`

# Usage

Add a config YML file to enable:

```

---
Name: httptest
---
DorsetDigital\HTTP2\DDMiddleware:
  enabled: true
```

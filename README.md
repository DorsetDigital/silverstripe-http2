# silverstripe-http2

> **Archived / no longer maintained**
>
> This module has been superseded by [DorsetDigital/silverstripe-enhanced-requirements](https://github.com/DorsetDigital/silverstripe-enhanced-requirements), which provides this functionality alongside additional Requirements features. Existing users should migrate to `dorsetdigital/silverstripe-enhanced-requirements`. No further development is planned for this package.


*Please note: The functionality this module provides is now available in a different module that also provides additional functionality:  https://github.com/DorsetDigital/silverstripe-enhanced-requirements*

*This module will remain, but will not be actively developed beyond critical bugfixes.  Please use the enhanced requirements module from now on*

--------------------------------------------------------------------


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

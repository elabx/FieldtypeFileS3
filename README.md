The module extends the default FieldtypeFile and InputfieldFile modules and adds few extra methods.

For the most part it behaves just like the default files modules, the biggest difference is how you get the file's url. Instead of using $page->fieldname->url you use $page->fieldname->s3url(). Files are not stored locally, they are deleted when the page is saved, if page saving is ommited the file remains on the local server until the page is saved. Another difference is the file size, the default module get the file size directly from the local file, while here it's stored in the database.


# Installation

[How to install or uninstall modules](http://modules.processwire.com/install-uninstall/)

# Setup

The configuration options are available in the InputfieldFileS3 module settings.

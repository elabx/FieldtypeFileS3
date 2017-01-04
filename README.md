The module extends the default FieldtypeFile and InputfieldFile modules and adds few extra methods.

For the most part it behaves just like the default files modules, the biggest difference is how you get the file's url. Instead of using $page->fieldname->url you use $page->fieldname->s3url(). Files are not stored locally, they are deleted when the page is saved, if page saving is ommited the file remains on the local server until the page is saved. Another difference is the file size, the default module get the file size directly from the local file, while here it's stored in the database.

There is an option to store the files locally, its intented in case one wants to stop using S3 and change back to local storage. What it does is it changes the s3url() method to serve files from local server instead of S3, disables uploading to S3 and disables local file deletion on page save. It does not tranfer files from S3 to local server, that can be done with the [aws-cli's](http://docs.aws.amazon.com/cli/latest/reference/s3/) through the [sync](http://docs.aws.amazon.com/cli/latest/reference/s3/sync.html) function. Files stored on S3 have the same structure as they would have on the local server.

# Installation

[How to install or uninstall modules](http://modules.processwire.com/install-uninstall/)

# Setup

The configuration options are available in the InputfieldFileS3 module settings.

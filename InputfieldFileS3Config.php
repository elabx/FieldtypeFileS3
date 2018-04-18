<?php namespace ProcessWire;

class InputfieldFileS3Config extends ModuleConfig {

    public function __construct() {
        $this->add(array(
            // Text field: Key
            array(
                'name'  => 'key',
                'type'  => 'text',
                'label' => $this->_('Key'),
                'description' => $this->_('Key used for authentication'),
                'notes' => $this->_("[Info!](http://docs.aws.amazon.com/general/latest/gr/managing-aws-access-keys.html)"),
                'required' => true,
				'columnWidth' => 50,
                'value' => $this->_(''),
            ),
            // Text field: Secret
            array(
                'name'  => 'secret',
                'type'  => 'text',
                'label' => $this->_('Secret'),
                'description' => $this->_('Secret used for authentication'),
                'notes' => $this->_("[Info!](http://docs.aws.amazon.com/general/latest/gr/managing-aws-access-keys.html)"),
                'required' => true,
				'columnWidth' => 50,
                'value' => $this->_(''),
            ),
            // Text field: Bucket
            array(
                'name'  => 'bucket',
                'type'  => 'text',
                'label' => $this->_('Bucket name'),
                'description' => $this->_("Set bucket name. Bucket must exist beforehand."),
                'notes' => $this->_("To serve files from own (sub)domain [see here](http://docs.aws.amazon.com/AmazonS3/latest/dev/VirtualHosting.html#VirtualHostingCustomURLs)"
				),
                'required' => true,
				'columnWidth' => 50,
                'value' => $this->_(''),
            ),
			// Select field: ACL
			array(
				'name'  => 'ACL',
				'type'  => 'select',
				'label' => $this->_('ACL'),
				'description' => $this->_('Access Control List'),
				'notes' => $this->_("[Info!](http://docs.aws.amazon.com/AmazonS3/latest/dev/acl-overview.html#canned-acl)"),
				'required' => true,
				'options' => array(
					'private'     => 'private',
					'public-read' => 'public-read',
					'public-read-write'  => 'public-read-write',
					'aws-exec-read'      => 'aws-exec-read',
					'authenticated-read' => 'authenticated-read',
					'bucket-owner-read'  => 'bucket-owner-read',
					'bucket-owner-full-control' => 'bucket-owner-full-control',
					'log-delivery-write' => 'log-delivery-write',
				),
				'columnWidth' => 50,
				'value' => $this->_('public-read'),
			),

			// Select field: Region
			array(
				'name'  => 'region',
				'type'  => 'select',
				'label' => $this->_('Region'),
				'description' => $this->_('Select a region for files to be stored.'),
				'notes' => $this->_("[Info!](http://docs.aws.amazon.com/general/latest/gr/rande.html#s3_region)"),
				'required' => true,
				'options' => array(
					'us-east-1'      => 'US East (N. Virginia)',
					'us-east-2'      => 'US East (Ohio)',
					'us-west-1'      => 'US West (N. California)',
					'us-west-2'      => 'US West (Oregon)',
					'ca-central-1'   => 'Canada (Central)',
					'eu-west-1'      => 'EU (Ireland)',
					'eu-west-2'      => 'EU (London)',
					'eu-central-1'   => 'EU (Frankfurt)',
					'ap-south-1'     => 'Asia Pacific (Mumbai)',
					'ap-southeast-1' => 'Asia Pacific (Singapore)',
					'ap-southeast-2' => 'Asia Pacific (Sydney)',
					'ap-northeast-1' => 'Asia Pacific (Tokyo)',
					'ap-northeast-2' => 'Asia Pacific (Seoul)',
					'sa-east-1'      => 'South America (São Paulo)',
		        ),
				'columnWidth' => 50,
				'value' => $this->_('eu-central-1'),
			),

			// Checkbox field: useSSL
			array(
				'name'  => 'useSSL',
				'type'  => 'checkbox',
				'label' => $this->_('Use SSL'),
				'description' => $this->_('If checked it will use https for the files url.'),
				'columnWidth' => 50,
				'value' => $this->_('1'),
			),

			// Checkbox field: useMyDomain
			array(
				'name'  => 'useMyDomain',
				'type'  => 'checkbox',
				'label' => $this->_('Use my domain'),
				'description' => $this->_('Use my domain to serve files'),
				'notes' => $this->_(
					'If checked will use your domain to serve files url. To use this the bucket name must be a (sub)domain.
					[Info!](http://docs.aws.amazon.com/AmazonS3/latest/dev/VirtualHosting.html#VirtualHostingCustomURLs)'
				),
				'columnWidth' => 50,
				'value' => $this->_('1'),
			),

			// Checkbox field: localStorage
			array(
				'name'  => 'localStorage',
				'type'  => 'checkbox',
				'label' => $this->_('Store files locally'),
				'description' => $this->_('If checked, files files will be stored locally instead of Amazon\'s S3.'),
				'notes' => $this->_(
					'This option only changes the url of the files from aws to local and disables local file deletion.
					For files already on S3 you\'d have to transfer them yourself, you can use aws-cli\'s sync function for that.
					[Info aws-cli!](http://docs.aws.amazon.com/cli/latest/reference/s3/sync.html)'
				),
				'columnWidth' => 50,
				'value' => $this->_('1'),
			),
            
            array(
                'name'=> "cfOptions",
                'type'=> 'fieldset',
                'label'=> 'Cloudfront Options',
                'children'=> array(
                    array(
                        'name'  => 'cf',
                        'type'  => 'checkbox',
                        'label' => $this->_('Use CloudFront to serve the assets'),
                        'description' => $this->_('Check if you want to serve the assets directly from Amazon CloudFront. Uncheck if you want to serve the asset files from the server where ProcessWire is installed.'),
                        'columnWidth' => 100
                    ),
            
                    array(
                        'name'  => 'cfurl',
                        'type'  => 'text',
                        'label' => $this->_('Domain name for the CloudFront distribution:'),
                        'description' => $this->_('Set up a CloudFront distribution pointing to the S3 bucket above and deploy it. Use the domain name provided by Amazon or set up your own CNAME pointing to that domain.'),
                        'columnWidth' => 100
                    ),
                     array(
                        'name'  => 'cacheHeader',
                        'type'  => 'integer',
                        'notes' => $this->_('Ex: 3600 = 1 hour; 86400 = 24 hours; 604800 = 7 days; 2592000 = 30 days'),
                        'label' => $this->_('Set Cache-Control Directive for the files uploaded to S3'),
                        'description' => $this->_('Fill this field with the a number of seconds, it will set an Cache-Control: max-age=seconds on the files to handle the browser and CloudFront cache. Read more about it [here](http://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/Expiration.html). Leaving the field blank doesn\'t add any directive to the files.'),
                        'columnWidth' => 100,
                        'value' => 86400
                    )
                )
            )
            
        ));
    }
}

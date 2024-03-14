<?php return array (
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://salary.b2bdigitize.com/',
    'asset_url' => NULL,
    'timezone' => 'Europe/Copenhagen',
    'locale' => 'da',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:kTDz/2WmJ5YTadkUwggSLk2H9fwG/IpaH541GjtpwFU=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Intervention\\Image\\ImageServiceProvider',
      27 => 'App\\Providers\\PermissionsServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
        'lock_connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp\\htdocs\\salary\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'salary',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'salary',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'salary',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'salary',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'laravel_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\salary\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\salary\\public',
        'url' => 'https://salary.b2bdigitize.com//public',
        'visibility' => 'public',
      ),
      'real_public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\salary\\public',
        'url' => 'https://salary.b2bdigitize.com/',
        'visibility' => 'public',
        'throw' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
      ),
    ),
    'links' => 
    array (
      'C:\\xampp\\htdocs\\salary\\public\\storage' => 'C:\\xampp\\htdocs\\salary\\storage\\app/public',
    ),
  ),
  'global' => 
  array (
    'translation' => 
    array (
      'section' => 
      array (
        'main' => 
        array (
          'name' => 'Common',
          'values' => 
          array (
            'pages' => 'Pages',
            'dashboard' => 'Dashboard',
            'pos' => 'POS',
            'orders' => 'Orders',
            'order_status_screen' => 'Order Status Screen',
            'customers' => 'Customers',
            'inventory' => 'Inventory',
            'products' => 'Products',
            'category' => 'Category',
            'table' => 'Table',
            'reports' => 'Reports',
            'settings' => 'Settings',
            'logout' => 'Logout',
            'translations' => 'Translations',
            'account_settings' => 'Account Settings',
            'app_settings' => 'App Settings',
            'version' => 'Version',
            'cooking_status' => 'Cooking Status',
            'back_to_dashboard' => 'Back To Dashboard',
            'email' => 'Email',
            'password' => 'Password',
            'enter_email' => 'Enter your email',
            'enter_password' => 'Enter your password',
            'forgot_password' => 'Forgot password?',
            'remember_me_next' => 'Remember me next time',
            'sign_in' => 'Sign in',
            'sl' => 'Sl',
            'name' => 'Name',
            'phone' => 'Phone',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'actions' => 'Actions',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'close' => 'Close',
            'save' => 'Save',
            'view' => 'View',
            'all_category' => 'All Category',
            'no_items_found' => 'No Items Were Found',
            'add' => 'Add',
            'item' => 'Item',
            'price' => 'price',
            'qty' => 'QTY',
            'total' => 'Total',
            'subtotal' => 'Subtotal',
            'discount' => 'Discount',
            'enter_discount' => 'Enter Discount',
            'service_charge' => 'Service Charge',
            'enter_service_charge' => 'Enter Service Charge',
            'tax_amount' => 'Tax Amount',
            'clear_all' => 'Clear All',
            'status' => 'Status',
            'is_active' => 'IsActive',
            'submit' => 'Submit',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'amount' => 'Amount',
            'back' => 'Back',
            'lifetime_orders' => 'Lifetime Orders',
            'today_order' => 'Today Order',
            'today_sale' => 'Today Sale',
            'total_customer' => 'Total Customer',
            'overview' => 'Overview',
            'latest_orders' => 'Latest Orders',
            'pending_orders' => 'Pending Orders',
          ),
        ),
        'reports' => 
        array (
          'name' => 'Reports',
          'values' => 
          array (
            'sales_report' => 'Sales Report',
            'day_wise_report' => 'Day Wise Sales Report',
            'item_wise_report' => 'Item Wise Sales Report',
            'customer_report' => 'Customer Report',
            'search_customer' => 'Search Customer',
            'search' => 'Search',
            'customer_name' => 'Customer Name',
            'total_sales' => 'Total Sales',
            'total_paid' => 'Total Paid',
            'balance' => 'Balance',
            'no_data_found' => 'No Data Was Found',
            'all_customers' => 'All Customers',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'date' => 'Date',
            'no_of_orders' => 'No Of Orders',
            'sales_total' => 'Sales Total',
            'payments_received' => 'Payments Received',
            'search_item' => 'Search Item',
            'all_items' => 'All Items',
            'all_types' => 'All Types',
            'no_orders_found' => 'No Orders were found',
          ),
        ),
        'tables' => 
        array (
          'name' => 'Tables',
          'values' => 
          array (
            'select_tables' => 'Select Table',
            'choose_table' => 'Choose Table',
            'tables' => 'Tables',
            'new_table' => 'New Table',
            'no_tables_found' => 'No Tables Were Found',
            'add_new_table' => 'Add New Table',
            'edit_table' => 'Edit Table',
          ),
        ),
        'translations' => 
        array (
          'name' => 'Translations',
          'values' => 
          array (
            'add_translation' => 'Add Translation',
            'edit_translation' => 'Edit Translation',
            'language_name' => 'Enter Language Name',
            'icon' => 'Icon',
            'is_default' => 'Is Default',
            'default' => 'Default',
            'new_translation' => 'New Translation',
            'translations' => 'Translations',
            'no_translations_found' => 'No Translations Found',
          ),
        ),
        'settings' => 
        array (
          'name' => 'Settings',
          'values' => 
          array (
            'contact_number' => 'Contact Number',
            'enter_contact_number' => 'Enter Contact Number',
            'save_changes' => 'Save Changes',
            'store_name' => 'Store Name',
            'enter_store_name' => 'Enter Stpre Name',
            'application_logo' => 'Application Logo',
            'fav_icon' => 'Fav Icon',
            'currency_symbol' => 'Currency Symbol',
            'enter_currency_symbol' => 'Enter Currency Symbol',
            'tax_percentage' => 'Tax Percentage',
            'enter_tax_percentage' => 'Enter Tax Percentage',
          ),
        ),
        'customers' => 
        array (
          'name' => 'Customers',
          'values' => 
          array (
            'new_customer' => 'New Customer',
            'add_new_customer' => 'Add New Customer',
            'edit_customer' => 'Edit Customer',
            'customer' => 'Customer',
            'customer_info' => 'Customer Info',
          ),
        ),
        'payments' => 
        array (
          'name' => 'Payments',
          'values' => 
          array (
            'payment_type' => 'Payment Type',
            'cash' => 'Cash',
            'card' => 'Card',
            'cheque' => 'Cheque',
            'bank_transfer' => 'Bank Transfer',
            'paid_amount' => 'Paid Amount',
            'enter_payment' => 'Enter Payment',
            'paid' => 'Paid',
            'unpaid' => 'Unpaid',
            'enter_paid_amount' => 'Enter Paid Amount',
            'add_payment' => 'Add Payment',
          ),
        ),
        'inventory' => 
        array (
          'name' => 'Inventory',
          'values' => 
          array (
            'search_product' => 'Search Product',
            'no_items_found' => 'No Items Were Found',
            'category' => 'Category',
            'new_category' => 'New Category',
            'add_new_category' => 'Add New Category',
            'description' => 'Description',
            'edit_category' => 'Edit Categpry',
            'no_categories_found' => 'No Categories Were Found',
            'create_product' => 'Create Product',
            'edit_product' => 'Edit Product',
            'product_code' => 'Product Code',
            'product_name' => 'Product Name',
            'choose' => 'Choose...',
            'image' => 'Image',
            'is_veg' => 'IsVeg',
            'add_addons' => 'Add Addons',
            'variants' => 'Variants',
            'extras' => 'Extras',
            'add_variant' => 'Add Variant',
            'no_variant_addons_found' => 'No Variant Addons Were Found',
            'no_extra_addons_found' => 'No Extra Addons Were Found',
            'add_extra' => 'Add Extra',
            'add_new' => 'Add New',
            'new_product' => 'New Product',
            'no_products_found' => 'No Products Found',
            'item_name' => 'Item Name',
          ),
        ),
        'orders' => 
        array (
          'name' => 'Order',
          'values' => 
          array (
            'new_order' => 'New Order',
            'pending' => 'Pending',
            'cooking' => 'Cooking',
            'ready' => 'Ready',
            'completed' => 'Completed',
            'order_type' => 'Order Type',
            'table_no' => 'Table No',
            'order_no' => 'Order No',
            'bill_amount' => 'Bill Amount',
            'mark_as_completed' => 'Mark as completed',
            'order_details' => 'Order Details',
            'order_status' => 'Order Status',
            'payment_details' => 'Payment Details',
            'more' => 'More',
            'actions' => 'Actions',
            'order_id' => 'Order ID',
            'order_date' => 'Order Date',
            'walk_in_customer' => 'Walk In Customer',
            'dining' => 'Dining',
            'takeaway' => 'Takeaway',
            'delivery' => 'Delivery',
            'total' => 'Total',
            'paid' => 'Paid',
            'balance' => 'Balance',
            'no_orders_found' => 'No Orders were found',
            'mark_as' => 'Mark As',
            'bill_total' => 'Bill Total',
            'place_order' => 'Place Order',
            'variant_info' => 'If a variant is selected, the variant price is used instead of the product price.',
            'variant' => 'Variant',
            'extra' => 'Extra',
            'today_cooking_status' => 'Today Cooking Status',
            'add_something_to_cart' => 'Add Something to the cart!',
            'no_cooking_items' => 'No Cooking Items',
            'print_invoice' => 'Print Invoice',
            'print_kot' => 'Print KOT',
            'customer_info' => 'Customer Info',
            'company_info' => 'Company Info',
            'invoice_info' => 'Invoice Info',
            'payment_status' => 'Payment Status',
          ),
        ),
        'staffs' => 
        array (
          'name' => 'Staffs',
          'values' => 
          array (
            'new_staff' => 'New Staff',
            'staffs' => 'Staffs',
            'staff_name' => 'Staff Name',
            'enter_staff_name' => 'Enter Staff Name',
            'permissions' => 'Permissions',
            'menu_title' => 'Menu Title',
            'edit_staff' => 'Edit Staff',
            'create_new_staff' => 'Create New Staff',
            'no_staffs_found' => 'No staffs were found..',
          ),
        ),
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 65536,
      'threads' => 1,
      'time' => 4,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'deprecations' => NULL,
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\xampp\\htdocs\\salary\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\xampp\\htdocs\\salary\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => 'C:\\xampp\\htdocs\\salary\\storage\\logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'mailhog',
        'port' => '1025',
        'encryption' => NULL,
        'username' => NULL,
        'password' => NULL,
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -t -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => NULL,
      'name' => 'Laravel',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\xampp\\htdocs\\salary\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'salary.b2bdigitize.com',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
      'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp\\htdocs\\salary\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\salary\\resources\\views',
    ),
    'compiled' => 'C:\\xampp\\htdocs\\salary\\storage\\framework\\views',
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'livewire' => 
  array (
    'class_namespace' => 'App\\Http\\Livewire',
    'view_path' => 'C:\\xampp\\htdocs\\salary\\resources\\views/livewire',
    'layout' => 'layouts.app',
    'asset_url' => NULL,
    'app_url' => NULL,
    'middleware_group' => 'web',
    'temporary_file_upload' => 
    array (
      'disk' => NULL,
      'rules' => NULL,
      'directory' => NULL,
      'middleware' => NULL,
      'preview_mimes' => 
      array (
        0 => 'png',
        1 => 'gif',
        2 => 'bmp',
        3 => 'svg',
        4 => 'wav',
        5 => 'mp4',
        6 => 'mov',
        7 => 'avi',
        8 => 'wmv',
        9 => 'mp3',
        10 => 'm4a',
        11 => 'jpg',
        12 => 'jpeg',
        13 => 'mpga',
        14 => 'webp',
        15 => 'wma',
      ),
      'max_upload_time' => 5,
    ),
    'manifest_path' => NULL,
    'back_button_cache' => false,
    'render_on_redirect' => false,
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
        'test_auto_detect' => true,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\xampp\\htdocs\\salary\\storage\\framework/cache/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'dotenv-editor' => 
  array (
    'autoBackup' => true,
    'backupPath' => 'C:\\xampp\\htdocs\\salary\\storage/dotenv-editor/backups/',
    'alwaysCreateBackupFolder' => false,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);

<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

use function now;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = now()->getTimestamp();
        
        // Add the articles.
        DB::table('article')->insert([
            [
                'author_id' => 1,
                'title' => 'REST API',
                'slug' => 'rest-api',
                'excerpt'   => 'The REST API can be used to access data and perform actions from external applications.',
                'text' => $text = '<div class="sp-editor-content">
<p>The REST API can be used to access data and perform actions from external applications.</p>
<p>&nbsp;</p>
<h2>Current Version</h2>
<p>The current version of the API is <strong>v2</strong>.</p>
<p>&nbsp;</p>
<h2>Multiple Formats</h2>
<p>The default format of API responses is XML, but JSON and YAML are also available options. The URL needs to be adjusted as in the below example of listing all departments.</p>
<p>&nbsp;</p>
<pre><a href="http://mydomain.com/api/v2/Tickets/Department/?time=%3Ctime%3E%26hash%3D%3Chash%3E">http://mydomain.com/api/v2/Tickets/Department/?time=&lt;time&gt;&amp;hash=&lt;hash&gt;</a>
<a href="http://mydomain.com/api/v2/Tickets/Department.json/?time=%3Ctime%3E%26hash%3D%3Chash%3E">http://mydomain.com/api/v2/Tickets/Department.json/?time=&lt;time&gt;&amp;hash=&lt;hash&gt;</a>
<a href="http://mydomain.com/api/v2/Tickets/Department.xml/?time=%3Ctime%3E%26hash%3D%3Chash%3E">http://mydomain.com/api/v2/Tickets/Department.xml/?time=&lt;time&gt;&amp;hash=&lt;hash&gt;</a>
<a href="http://mydomain.com/api/v2/Tickets/Department.yaml/?time=%3Ctime%3E%26hash%3D%3Chash%3E">http://mydomain.com/api/v2/Tickets/Department.yaml/?time=&lt;time&gt;&amp;hash=&lt;hash&gt;</a>
</pre>
<p>&nbsp;</p>
<h2>Authentication</h2>
<p>The hash parameter is created by the following function.</p>
<p>&nbsp;</p>
<pre>$hash = md5($rest_api_key . \'@@@@\' . time());</pre>
<p>&nbsp;</p>
<p>Time and hash are required parameters for using the API.</p>
<p>&nbsp;</p>
<h2>Logging</h2>
<p>Optionally, you can also use the <strong>staff_id</strong> parameter, which refers to the ID of the operator using the API for logging purposes.</p>
</div>',
		        'purified_text' => $text,
		        'plain_text' => 'The REST API can be used to access data and perform actions from external applications.
Current Version
The current version of the API is v2.

Multiple Formats
The default format of API responses is XML, but JSON and YAML are also available options. The URL needs to be adjusted as in the below example of listing all departments.
http://mydomain.com/api/v2/Tickets/Department/?time=<time>&hash=<hash>http://mydomain.com/api/v2/Tickets/Department.json/?time=<time>&hash=<hash>http://mydomain.com/api/v2/Tickets/Department.xml/?time=<time>&hash=<hash>http://mydomain.com/api/v2/Tickets/Department.yaml/?time=<time>&hash=<hash>

Authentication
The hash parameter is created by the following function.
$hash = md5($rest_api_key . \'@@@@\' . time());
Time and hash are required parameters for using the API.

Logging
Optionally, you can also use the staff_id parameter, which refers to the ID of the operator using the API for logging purposes.',
                'published' => 1,
                'published_at' => $time,
                'protected' => 0,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'author_id' => 1,
                'title' => 'SimpleAuth',
                'slug' => 'simpleauth',
                'excerpt'   => 'SimpleAuth is an automatic authentication method to allow you to log users in from third party code/software.',
                'text' => $text = '<p>SimpleAuth is an automatic authentication method to allow you to log users in from third party code/software. Useful in integrations with other client management software, it will generate a session for the user without them having to do anything or requiring the user\'s password.<br /><br />It works by constructing a special link to the login page that includes the user\'s email address, a timestamp and a hash that is generated from a defined key and the timestamp, and you can also add a redirection URL on successful authentication.<br /><br />SimpleAuth relies on a defined secret key in the configuration file. This is used to generate the hash and validate any requests.</p>
<p>&nbsp;</p>
<h2>Activate SimpleAuth</h2>
<p>SimpleAuth can be used by setting a key like below in the config.php file found in the includes folder. A key may currently be set, but you are welcome to change it to any random string of characters and numbers.</p>
<p>&nbsp;</p>
<pre>$SIMPLEAUTH_KEY = "RhqFi31PpIe0eIyP08fNqA";</pre>
<p>&nbsp;</p>
<h2>Using SimpleAuth</h2>
<p>To use SimpleAuth, we need to generate a hash for each request. This hash is generated by combining the user\'s email address, the secret key and the current timestamp like below. The timestamp must be within 10 minutes of the server time or else the request will be invalid.</p>
<p>&nbsp;</p>
<pre>md5($email . $SIMPLEAUTH_KEY . $time)</pre>
<p>&nbsp;</p>
<p>You can now use the resulting hash to build the request. To declare a redirect URL, use the \'back\' parameter. An example request is below.</p>
<p>&nbsp;</p>
<pre>login.php?email=test@test.com&amp;
time=1423680791&amp;hash=bdc391437d78377767b5d435356e04eb&amp;back=<a href="http://domain.com/clientarea.php">http://domain.com/clientarea.php</a></pre>
<p>&nbsp;</p>
<h2>Errors</h2>
<p>If the hash is invalid, the timestamp is outdated or no key has been set, the script will return a json string that contains details of the error.</p>
<p>&nbsp;</p>
<h2>Sample Code</h2>
<pre><strong>&lt;?php</strong>
 
<em>// Set the login URL and SimpleAuth key</em>
    $loginUrl = \'<a href="https://www.domain.com/support/login.php">https://www.domain.com/support/login.php</a>\';
$simpleAuthKey = \'RhqFi31PpIe0eIyP08fNqA\';
 
<em>// Set variables for hash</em>
    $email = \'test@test.com\';
$time = time();
$back = \'<a href="http://domain.com/clientarea.php">http://domain.com/clientarea.php</a>\';
 
<em>// Generate hash</em>
    $hash = md5($email . $simpleAuthKey . $time);
 
<em>// Generate request and access it</em>
    $request = $loginUrl . \'?email=\' . $email . \'&amp;time=\' . $time . \'&amp;hash=\' . $hash . \'&amp;back=\' . urlencode($back);
header("Location: $request");
exit;</pre>',
                'purified_text' => $text,
		        'plain_text' => 'SimpleAuth is an automatic authentication method to allow you to log users in from third party code/software. Useful in integrations with other client management software, it will generate a session for the user without them having to do anything or requiring the user\'s password.It works by constructing a special link to the login page that includes the user\'s email address, a timestamp and a hash that is generated from a defined key and the timestamp, and you can also add a redirection URL on successful authentication.SimpleAuth relies on a defined secret key in the configuration file. This is used to generate the hash and validate any requests.Activate SimpleAuthSimpleAuth can be used by setting a key like below in the config.php file found in the includes folder. A key may currently be set, but you are welcome to change it to any random string of characters and numbers.$SIMPLEAUTH_KEY = "RhqFi31PpIe0eIyP08fNqA";Using SimpleAuthTo use SimpleAuth, we need to generate a hash for each request. This hash is generated by combining the user\'s email address, the secret key and the current timestamp like below. The timestamp must be within 10 minutes of the server time or else the request will be invalid.md5($email . $SIMPLEAUTH_KEY . $time)You can now use the resulting hash to build the request. To declare a redirect URL, use the \'back\' parameter. An example request is below.login.php?email=test@test.com&
time=1423680791&hash=bdc391437d78377767b5d435356e04eb&back=http://domain.com/clientarea.phpErrorsIf the hash is invalid, the timestamp is outdated or no key has been set, the script will return a json string that contains details of the error.',
                'published' => 1,
                'published_at' => now()->subDay()->subHour()->subMinutes(11)->getTimestamp(),
                'protected' => 0,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'author_id' => 1,
                'title' => 'Upgrade an Existing Install', // Registered Users Only
                'slug' => 'upgrade-an-existing-install',
                'excerpt'   => 'A license with a valid support & upgrade subscription is required to download.',
                'text' => $text = '<h2>Downloading</h2>
<p>A license with a valid support &amp; upgrade subscription is required to download. Owned licenses include 6 months from date of purchase and leased licenses include lifetime support &amp; upgrades. Once you have a valid license please login to the members area, select an active license and choose the latest version you wish to download.<br /><br /><strong>Please note, if your license does not have a valid support &amp; upgrades subscription and you attempt to install a product version released after your subscription expired, the install process will fail.</strong><br /><br /></p>
<h2>Upgrade Steps</h2>
<p>Upgrading is fairly simple, follow the following steps to upgrade to the latest version:</p>
<ol>
<li>Take a backup of your database</li>
<li>Download the latest version from our members area</li>
<li>Unzip the contents of the downloaded zip file</li>
<li>Upload and overwrite all the files on your server with those from the new version (if you are using FTP use Binary Mode), ensure to backup any files that you have modified previously</li>
<li>Start the upgrade process by visiting <a href="http://yourdomain.com/">http://yourdomain.com/</a>&lt;foldername&gt;/install/</li>
<li>Login to an administrator account</li>
<li>Follow the instructions provided by the installer</li>
<li>Remember to clear your cache or do a hard refresh (Ctrl + R on Windows) when accessing the operator panel after completing the upgrade</li>
<li>Enjoy</li>
</ol>',
                'purified_text' => $text,
		        'plain_text' => 'Downloading A license with a valid support & upgrade subscription is required to download. Owned licenses include 6 months from date of purchase and leased licenses include lifetime support & upgrades. Once you have a valid license please login to the members area, select an active license and choose the latest version you wish to download.Please note, if your license does not have a valid support & upgrades subscription and you attempt to install a product version released after your subscription expired, the install process will fail.Upgrade StepsUpgrading is fairly simple, follow the following steps to upgrade to the latest version:
• Take a backup of your database
• Download the latest version from our members area
• Unzip the contents of the downloaded zip file
• Upload and overwrite all the files on your server with those from the new version (if you are using FTP use Binary Mode), ensure to backup any files that you have modified previously
• Start the upgrade process by visiting http://yourdomain.com/<foldername>/install/
• Login to an administrator account
• Follow the instructions provided by the installer
• Remember to clear your cache or do a hard refresh (Ctrl + R on Windows) when accessing the operator panel after completing the upgrade
• Enjoy',
                'published' => 1,
                'protected' => 1,
                'published_at' => now()->subDays(5)->subHours(3)->subMinutes(24)->getTimestamp(),
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'author_id' => 1,
                'title'     => 'License Information', // Draft article - not publicly viewable.
                'slug'      => 'license-information',
                'excerpt'   => 'The application requires a valid license to function. All licenses are prefixed with "LIC-".',
                'text'      => $text = '<p>The application requires a valid license to function. All licenses are prefixed with "LIC-".</p>
<p>&nbsp;</p>
<p>Once you have set up with a valid license key, visiting Help -&gt; License Information will provide you with all the relevant information attached to your license. Most of this information can also be found with your license at our client area.</p>
<p>&nbsp;</p>
<h2>Changing the License Key in your Installation</h2>
<p>Visit Help -&gt; License Information and click "Change license" next to the current license key. Enter your new key and then click save. If you are unable to access the operator area due to a license error, there should be an option to change the license key on the error page. For either option to work, it requires that the file <code>/includes/config.php</code> is CHMOD 777.</p>
<p>&nbsp;</p>
<h2>License Errors</h2>
<h3>License Invalid</h3>
<p>This error generally appears when your server IP has changed or you have moved the installation to another domain/folder within the same server.<br /><br />It can be resolved by logging in to our client area, find your license under My Services and clicking <strong>Re-Issue License</strong> under <strong>Management Actions</strong>. You should then proceed to your operator panel login again, where you can now log in.</p>
<p>&nbsp;</p>
<p>Please contact us if this does not solve the issue.</p>',
                'purified_text' => $text,
                'plain_text' => 'The application requires a valid license to function. All licenses are prefixed with "LIC-".Once you have set up with a valid license key, visiting Help -> License Information will provide you with all the relevant information attached to your license. Most of this information can also be found with your license at our client area.
Changing the License Key in your Installation
Visit Help -> License Information and click "Change license" next to the current license key. Enter your new key and then click save. If you are unable to access the operator area due to a license error, there should be an option to change the license key on the error page. For either option to work, it requires that the file /includes/config.php is CHMOD 777.
License Errors
License Invalid
This error generally appears when your server IP has changed or you have moved the installation to another domain/folder within the same server.It can be resolved by logging in to our client area, find your license under My Services and clicking Re-Issue License under Management Actions. You should then proceed to your operator panel login again, where you can now log in.Please contact us if this does not solve the issue.',
                'published' => 0,
                'protected' => 0,
                'published_at' => now()->subDays(8)->subHours(12)->subMinutes(51)->getTimestamp(),
                'created_at'=> $time,
                'updated_at'=> $time
            ],
            [
                'author_id' => 1,
                'title'     => 'New Installations',
                'slug'      => 'new-installations',
                'excerpt'   => 'A license with valid support & upgrade coverage is required to download.',
                'text'      => $text = '<h2>Downloading</h2>
<p>A license with valid support &amp; upgrade coverage is required to download. Once you have a valid license please login to the members area select an active license and download the latest version.</p>
<p>&nbsp;</p>
<h2>Installation Steps</h2>
<p>The installation process is fairly simple, follow the following steps to get started:</p>
<ol>
<li>Download the software from our members area</li>
<li>Unzip the contents of the downloaded zip file</li>
<li>In the includes folder, rename config-new.php to config.php</li>
<li>Upload the entire contents to your Webserver (If you are using FTP use Binary Mode)</li>
<li>Start the install process by visiting <a href="http://yourdomain.com/">http://yourdomain.com/</a>&lt;foldername&gt;/install/</li>
<li>Follow the instructions provided by the installer</li>
<li>Enjoy!</li>
</ol>
<h2>Post Installation Steps</h2>
<p>Once the installation has completed, we recommend to set includes/config.php back to CHMOD 644.</p>
<p>&nbsp;</p>
<h3>Cron Job</h3>
<p>The cron job allows task automation. Add a cron job to your server with an entry like:</p>
<p>&nbsp;</p>
<pre>* * * * * php -q /&lt;base_path&gt;/includes/cron.php
</pre>
<p>&nbsp;</p>
<p>Please make sure to replace the base path. If it doesn\'t work, it may be because PHP is on a different location on your server. For example, if PHP is located at <code>/usr/bin/php</code> then the cron job entry should be</p>
<p>&nbsp;</p>
<pre>* * * * * /usr/bin/php -q /&lt;base_path&gt;/includes/cron.php
    </pre>
<p>&nbsp;</p>
<p>You can set how often each task should run by visiting Scheduled Tasks under the Settings menu in your operator panel. The cron job would need to be updated should the base path change.</p>
<p>&nbsp;</p>
<h3>SEO Friendly Links</h3>
<p>If you intend on using SEO friendly links (generally recommended for better search engine positioning), then rename the <strong>htaccess</strong> file to <strong>.htaccess</strong> in the root directory. You will also need to enable the setting in Settings -&gt; General Settings -&gt; Template.</p>
<p>&nbsp;</p>
<h3>Rename the admin folder</h3>
<p>From a security point of view, it is a good idea to rename the operator panel folder to avoid anyone being able to access it. It should be renamed to something that only your staff members know.</p>
<p>&nbsp;</p>
<p>&gt;Once you have renamed the admin folder, open <code>/includes/config.php</code> within your installation and set the following variable to your new admin folder name</p>
<p>&nbsp;</p>
<pre>$ADMIN_FOLDER = "admin";</pre>
<p>&nbsp;</p>
<h3>Moving and securing the uploads folder</h3>
<p>As the uploads folder requires CHMOD permissions 777 (writable by anyone), it is safer to move the folder out of publicly accessible folders (everything under public_html or similar on your server).</p>
<p>&nbsp;</p>
<p>If you do move the uploads server, you must update the uploads path in the general settings section in the operator panel (Settings -&gt; General Settings -&gt; Company).</p>
<p>&nbsp;</p>
<p>Furthermore, if your server allows indexing through .htaccess files, please rename the <strong>htaccess </strong>file in the uploads folder to <strong>.htaccess</strong>. This will disable any PHP scripts being executed in that folder.</p>',
		        'purified_text' => $text,
		        'plain_text' => 'Downloading
A license with valid support & upgrade coverage is required to download. Once you have a valid license please login to the members area select an active license and download the latest version.
Installation StepsThe installation process is fairly simple, follow the following steps to get started:

• Download the software from our members area	
• Unzip the contents of the downloaded zip file	
• In the includes folder, rename config-new.php to config.php	
• Upload the entire contents to your Webserver (If you are using FTP use Binary Mode)	
• Start the install process by visiting http://yourdomain.com/<foldername>/install/	
• Follow the instructions provided by the installer	
• Enjoy!
Post Installation Steps
Once the installation has completed, we recommend to set includes/config.php back to CHMOD 644.

Cron Job
The cron job allows task automation. Add a cron job to your server with an entry like:
* * * * * php -q /<base_path>/includes/cron.php
Please make sure to replace the base path. If it doesn\'t work, it may be because PHP is on a different location on your server. For example, if PHP is located at /usr/bin/php then the cron job entry should be* * * * * /usr/bin/php -q /<base_path>/includes/cron.php
You can set how often each task should run by visiting Scheduled Tasks under the Settings menu in your operator panel. The cron job would need to be updated should the base path change.
SEO Friendly Links
If you intend on using SEO friendly links (generally recommended for better search engine positioning), then rename the htaccess file to .htaccess in the root directory. You will also need to enable the setting in Settings -> General Settings -> Template.

Rename the admin folder
From a security point of view, it is a good idea to rename the operator panel folder to avoid anyone being able to access it. It should be renamed to something that only your staff members know.Once you have renamed the admin folder, open /includes/config.php within your installation and set the following variable to your new admin folder name
$ADMIN_FOLDER = "admin";
Moving and securing the uploads folderAs the uploads folder requires CHMOD permissions 777 (writable by anyone), it is safer to move the folder out of publicly accessible folders (everything under public_html or similar on your server).If you do move the uploads server, you must update the uploads path in the general settings section in the operator panel (Settings -> General Settings -> Company).Furthermore, if your server allows indexing through .htaccess files, please rename the htaccess file in the uploads folder to .htaccess. This will disable any PHP scripts being executed in that folder.',
                'published' => 1,
                'published_at' => now()->subDays(9)->subHours(15)->subMinutes(32)->getTimestamp(),
                'protected' => 0,
                'created_at'=> $time,
                'updated_at'=> $time
            ],
            [
                'author_id'  => 1,
                'title'      => 'Welcome to the SupportPal Demo',
                'slug'       => 'welcome-to-the-supportpal-demo',
                'excerpt'    => 'Our demo installation automatically resets every 2 hours, if you experience problems logging in then please try again later.',
                'text'       => $text = '<p>Our demo installation automatically resets every 2 hours, if you experience problems logging in then please try again later. Please be aware that other users may be logged in the demo at the same time and may be making changes that could lead to unexpected results.</p>
<p>&nbsp;</p>
<p>We recommend our downloadable <a href="https://www.supportpal.com/product/freetrial">free trial</a> as the best way to try out the software.</p>',
		        'purified_text' => $text,
		        'plain_text' => 'Our demo installation automatically resets every 2 hours, if you experience problems logging in then please try again later. Please be aware that other users may be logged in the demo at the same time and may be making changes that could lead to unexpected results.

We recommend our downloadable <a href="https://www.supportpal.com/product/freetrial">free trial</a> as the best way to try out the software.',
                'published'  => 1,
                'published_at' => now()->subDays(10)->subHours(2)->subMinutes(1)->getTimestamp(),
                'protected'  => 0,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'author_id'  => 1,
                'title'      => 'Version 1.2.3',
                'slug'       => 'version-1-2-3',
                'excerpt'    => 'We are pleased to announce the stable release of Acme 1.2.3.',
                'text'       => $text = '<p>We are pleased to announce the stable release of Acme 1.2.3. The release contains many improvements and bug fixes, and introduces several new features over the previous release.</p>
<p>&nbsp;</p>
<p>Enter new features here when full changelog is available.</p>',
		        'purified_text' => $text,
		        'plain_text' => 'We are pleased to announce the stable release of Acme 1.2.3. The release contains many improvements and bug fixes, and introduces several new features over the previous release.

Enter new features here when full changelog is available.',
                'published'  => 0,
                'published_at' => now()->subDays(12)->subHours(2)->subMinutes(47)->getTimestamp(),
                'protected'  => 0,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);

        // Associate article with types.
        DB::table('article_type_membership')->insert([
            [ 'article_id' => 1, 'type_id' => 2 ],
            [ 'article_id' => 2, 'type_id' => 2 ],
            [ 'article_id' => 3, 'type_id' => 2 ],
            [ 'article_id' => 3, 'type_id' => 3 ],
            [ 'article_id' => 4, 'type_id' => 2 ],
            [ 'article_id' => 5, 'type_id' => 2 ],
            [ 'article_id' => 5, 'type_id' => 3 ],
            [ 'article_id' => 6, 'type_id' => 1 ],
            [ 'article_id' => 7, 'type_id' => 3 ],
        ]);

        // Associate categories.
        DB::table('article_cat_membership')->insert([
            [ 'article_id' => 1, 'category_id' => 4 ],
            [ 'article_id' => 1, 'category_id' => 5 ],
            [ 'article_id' => 2, 'category_id' => 4 ],
            [ 'article_id' => 3, 'category_id' => 3 ],
            [ 'article_id' => 3, 'category_id' => 7 ],
            [ 'article_id' => 4, 'category_id' => 3 ],
            [ 'article_id' => 5, 'category_id' => 3 ],
            [ 'article_id' => 5, 'category_id' => 7 ],
            [ 'article_id' => 6, 'category_id' => 1 ],
            [ 'article_id' => 6, 'category_id' => 2 ],
            [ 'article_id' => 7, 'category_id' => 8 ],
        ]);

        // Associate tags.
        DB::table('article_tag_membership')->insert([
            [ 'article_id' => 2, 'tag_id' => 1 ],
            [ 'article_id' => 3, 'tag_id' => 1 ],
            [ 'article_id' => 4, 'tag_id' => 1 ],
            [ 'article_id' => 1, 'tag_id' => 2 ],
            [ 'article_id' => 2, 'tag_id' => 2 ],
            [ 'article_id' => 7, 'tag_id' => 3 ],
        ]);

        // Activity Log
        $this->activityLog([
            [ 'rel_id' => 1, 'rel_name' => 'REST API' ],
            [ 'rel_id' => 2, 'rel_name' => 'SimpleAuth' ],
            [ 'rel_id' => 3, 'rel_name' => 'Upgrade an Existing Install' ],
            [ 'rel_id' => 4, 'rel_name' => 'License Information' ],
            [ 'rel_id' => 5, 'rel_name' => 'New Installations' ],
            [ 'rel_id' => 6, 'rel_name' => 'Welcome to the SupportPal Demo' ],
        ]);
    }

    /**
     * Add activity log entries.
     *
     * @param  array $data [ [ 'rel_name' => '', 'rel_id' => '' ], [ .. ] ]
     * @return void
     */
    private function activityLog(array $data)
    {
        $default = [
            'type'          => 1,
            'rel_route'     => 'selfservice.operator.article.edit',
            'section'       => 'selfservice.article',
            'user_id'       => 1,
            'user_name'     => 'John Doe',
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => time(),
            'updated_at'    => time()
        ];

        foreach ($data as $k => $row) {
            $data[$k] = $row + $default;
        }

        DB::table('activity_log')->insert($data);
    }
}

<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\Brand;
use App\Modules\Ticket\Models\Channel;
use App\Modules\Ticket\Models\Department;
use App\Modules\Ticket\Models\DepartmentEmail;
use App\Modules\Ticket\Models\Priority;
use App\Modules\Ticket\Models\SlaPlan;
use App\Modules\Ticket\Models\Status;
use App\Modules\Ticket\Models\Tag;
use App\Modules\Ticket\Models\TicketCustomField;
use App\Modules\Ticket\Models\TicketCustomFieldValue;
use App\Modules\User\Models\User;
use Crypt;
use DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        $ticket1 = DB::table('ticket')->insertGetId([
            'number'      => '5872912',
            'department_id' => Department::where('name', 'Bugs')->firstOrFail()->id,
            'department_email_id' => DepartmentEmail::where('address', 'support@acmeltd.com')->firstOrFail()->id,
            'brand_id'    => Brand::where('name', 'SupportPal')->firstOrFail()->id,
            'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
            'user_id'     => User::where('email', 'joe@bloggs.corp')->firstOrFail()->id,
            'status_id'   => Status::where('name', 'Open')->firstOrFail()->id,
            'priority_id' => Priority::where('name', 'Medium')->firstOrFail()->id,
            'sla_plan_id' => SlaPlan::where('name', 'Technical Support')->firstOrFail()->id,
            'subject'     => 'Problems setting up email piping',
            'due_time'    => $time + 61200,
            'internal'    => 0,
            'locked'      => 0,
            'has_draft'   => 1,
            'last_reply_time' => $time - 3600,
            'created_at'  => $time - 3600,
            'updated_at'  => $time - 1739
        ]);

        $ticket2 = DB::table('ticket')->insertGetId([
            'number'      => 'SALES-63959',
            'department_id' => Department::where('name', 'Sales')->firstOrFail()->id,
            'department_email_id' => DepartmentEmail::where('address', 'brandsales@demo.com')->firstOrFail()->id,
            'brand_id'    => Brand::where('name', 'Brand Demo')->firstOrFail()->id,
            'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
            'user_id'     => User::where('email', 'bklein@echo.xyz')->firstOrFail()->id,
            'status_id'   => Status::where('name', 'Open')->firstOrFail()->id,
            'priority_id' => Priority::where('name', 'Low')->firstOrFail()->id,
            'sla_plan_id' => null,
            'subject'     => 'Would like to buy your software',
            'due_time'    => null,
            'internal'    => 0,
            'locked'      => 0,
            'has_draft'   => 0,
            'last_reply_time' => $time,
            'created_at'  => $time,
            'updated_at'  => $time
        ]);

        $ticket3 = DB::table('ticket')->insertGetId([
            'number'      => '7483029',
            'department_id' => Department::where('name', 'Services')->firstOrFail()->id,
            'department_email_id' => DepartmentEmail::where('address', 'brandservices@demo.com')->firstOrFail()->id,
            'brand_id'    => Brand::where('name', 'Brand Demo')->firstOrFail()->id,
            'channel_id'  => Channel::where('name', 'Email')->firstOrFail()->id,
            'user_id'     => User::where('email', 'bklein@echo.xyz')->firstOrFail()->id,
            'status_id'   => Status::where('name', 'In-Progress')->firstOrFail()->id,
            'priority_id' => Priority::where('name', 'Low')->firstOrFail()->id,
            'sla_plan_id' => null,
            'subject'     => 'Quote for Slack plugin',
            'due_time'    => null,
            'internal'    => 0,
            'locked'      => 0,
            'has_draft'   => 0,
            'last_reply_time' => $time - 2500,
            'created_at'  => $time - 10400,
            'updated_at'  => $time - 2500,
        ]);

        $ticket4 = DB::table('ticket')->insertGetId([
            'number'      => 'SALES-03139',
            'department_id' => Department::where('name', 'Billing')->firstOrFail()->id,
            'department_email_id' => DepartmentEmail::where('address', 'billing@acmeltd.com')->firstOrFail()->id,
            'brand_id'    => Brand::where('name', 'SupportPal')->firstOrFail()->id,
            'channel_id'  => Channel::where('name', 'API')->firstOrFail()->id,
            'user_id'     => User::where('email', 'joe@bloggs.corp')->firstOrFail()->id,
            'status_id'   => Status::where('name', 'Closed')->firstOrFail()->id,
            'priority_id' => Priority::where('name', 'High')->firstOrFail()->id,
            'sla_plan_id' => null,
            'subject'     => 'Payment issue with credit card',
            'due_time'    => null,
            'internal'    => 0,
            'locked'      => 1,
            'has_draft'   => 0,
            'last_reply_time' => $time - 86650,
            'created_at'  => $time - 87600,
            'updated_at'  => $time - 86650,
        ]);

        $ticket5 = DB::table('ticket')->insertGetId([
            'number'      => '1354619',
            'department_id' => Department::where('name', 'Support')->firstOrFail()->id,
            'department_email_id' => DepartmentEmail::where('address', 'support@acmeltd.com')->firstOrFail()->id,
            'brand_id'    => Brand::where('name', 'SupportPal')->firstOrFail()->id,
            'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
            'user_id'     => User::where('email', 'joe@bloggs.corp')->firstOrFail()->id,
            'status_id'   => Status::where('name', 'Awaiting Reply')->firstOrFail()->id,
            'priority_id' => Priority::where('name', 'Medium')->firstOrFail()->id,
            'sla_plan_id' => SlaPlan::where('name', 'Technical Support')->firstOrFail()->id,
            'subject'     => 'Suggestion to add 2FA as an option for admins',
            'due_time'    => $time + 61200,
            'internal'    => 0,
            'locked'      => 0,
            'has_draft'   => 0,
            'last_reply_time' => $time - 6800,
            'created_at'  => $time - 7400,
            'updated_at'  => $time - 6800
        ]);

        $ticket6 = DB::table('ticket')->insertGetId([
            'number'      => '9594392',
            'department_id' => Department::where('name', 'Support')->firstOrFail()->id,
            'department_email_id' => DepartmentEmail::where('address', 'support@acmeltd.com')->firstOrFail()->id,
            'brand_id'    => Brand::where('name', 'SupportPal')->firstOrFail()->id,
            'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
            'user_id'     => User::operator()->firstOrFail()->id,
            'status_id'   => Status::where('name', 'Open')->firstOrFail()->id,
            'priority_id' => Priority::where('name', 'Critical')->firstOrFail()->id,
            'sla_plan_id' => SlaPlan::where('name', 'Technical Support')->firstOrFail()->id,
            'subject'     => 'New hard drive required in server',
            'due_time'    => $time + 11596,
            'internal'    => 1,
            'locked'      => 0,
            'has_draft'   => 0,
            'last_reply_time' => $time - 100,
            'created_at'  => $time - 2804,
            'updated_at'  => $time - 100,
        ]);

        // Insert messages
        DB::table('ticket_message')->insert([
            [
                'ticket_id'   => $ticket1,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::where('email', 'joe@bloggs.corp')->firstOrFail()->id,
                'user_name'   => User::where('email', 'joe@bloggs.corp')->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 1,
                'type'        => 0,
                'excerpt'     => 'Hi there, I am having trouble setting up email piping on my server.',
                'text'        => $text = 'Hi there,<br /><br />I am having trouble setting up email piping on my server.<br /><br />I keep getting a \'local delivery failed\' message when trying to send an email to the department email address. Do you know what I might be doing wrong?<br /><br />Patrick',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 3600,
                'updated_at'  => $time - 3600
            ],
            [
                'ticket_id'   => $ticket1,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::operator()->firstOrFail()->id,
                'user_name'   => User::operator()->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 0,
                'type'        => 0,
                'excerpt'     => 'Hi Patrick, Thanks for contacting us, I\'ll try to help you with your problem.',
                'text'        => $text = 'Hi Patrick,<br /><br />Thanks for contacting us, I\'ll try to help you with your problem.<br /><br />If you\'re using cPanel, you may have to set the file permissions (CHMOD) on the \'pipe\' file in the main install directory to 755.<br /><br />Please give that a shot and let us kn',
                'purified_text' => $text,
                'is_draft'    => 1,
                'created_at'  => $time - 1739,
                'updated_at'  => $time - 1739
            ],
            [
                'ticket_id'   => $ticket2,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::where('email', 'bklein@echo.xyz')->firstOrFail()->id,
                'user_name'   => User::where('email', 'bklein@echo.xyz')->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 1,
                'type'        => 0,
                'excerpt'     => 'Hey, I am quite happy with the software trial and would like to look into purchasing',
                'text'        => $text = 'Hey,<br /><br />I am quite happy with the software trial and would like to look in to purchasing a license. Do you accept PayPal and how can I switch from my trial to a full license?<br /><br />Regards,<br />Pat',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'ticket_id'   => $ticket3,
                'channel_id'  => Channel::where('name', 'Email')->firstOrFail()->id,
                'user_id'     => User::where('email', 'andersonc@myemail.com')->firstOrFail()->id,
                'user_name'   => User::where('email', 'andersonc@myemail.com')->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 1,
                'type'        => 0,
                'excerpt'     => 'Hello, We use Slack and would like the software to post notifications to our',
                'text'        => $text = 'Hello,<br /><br />We use Slack and would like the software to post notifications to our channel when actions happens, what would the cost be for a plugin that achieves this?<br /><br />Clare',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 10400,
                'updated_at'  => $time - 10400
            ],
            [
                'ticket_id'   => $ticket3,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::operator()->firstOrFail()->id,
                'user_name'   => User::operator()->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 0,
                'type'        => 0,
                'excerpt'     => 'Hi Clare, Thanks for contacting us. Could you please provide some more',
                'text'        => $text = 'Hi Clare,<br /><br />Thanks for contacting us.<br /><br />Could you please provide some more details about what you would expect the plugin to achieve, what notifications it should send in particular, and I will be able to send you a quote.<br /><br />-----<br />Best Regards,<br /><br />John Doe<br /><strong>Demo</strong>',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 8040,
                'updated_at'  => $time - 8040
            ],
            [
                'ticket_id'   => $ticket3,
                'channel_id'  => Channel::where('name', 'Email')->firstOrFail()->id,
                'user_id'     => User::where('email', 'andersonc@myemail.com')->firstOrFail()->id,
                'user_name'   => User::where('email', 'andersonc@myemail.com')->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 1,
                'type'        => 0,
                'excerpt'     => 'Hi John, I think primarily we need it to send all notifications that are sent',
                'text'        => $text = 'Hi John,<br /><br />I think primarily we need it to send all notifications that are sent by email to a main channel. It\'d also be great if it could send personal notifications directly to the operator using direct messages, but I\'m not sure if this is possible.<br /><br />I hope this provides enough detail, but please let me know if you need any more information.<br /><br />Clare',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 6100,
                'updated_at'  => $time - 6100
            ],
            [
                'ticket_id'   => $ticket3,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::operator()->firstOrFail()->id,
                'user_name'   => User::operator()->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 0,
                'type'        => 0,
                'excerpt'     => 'Hi Clare, Thanks we will review this internally and get back to you shortly',
                'text'        => $text = 'Hi Clare,<br /><br />Thanks, we will review this internally and get back to you shortly.<br /><br />-----<br />Best Regards,<br /><br />John Doe<br /><strong>Demo</strong>',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 3100,
                'updated_at'  => $time - 3100
            ],
            [
                'ticket_id'   => $ticket3,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::operator()->firstOrFail()->id,
                'user_name'   => User::operator()->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 0,
                'type'        => 1,
                'excerpt'     => 'It seems if you use @ instead of # at the start of the channel name',
                'text'        => $text = 'It seems if you use @ instead of # at the start of the channel name, you can message someone directly so I think it might be possible to achieve.',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 2500,
                'updated_at'  => $time - 2500
            ],
            [
                'ticket_id'   => $ticket4,
                'channel_id'  => Channel::where('name', 'API')->firstOrFail()->id,
                'user_id'     => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->id,
                'user_name'   => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 1,
                'type'        => 0,
                'excerpt'     => 'Hey there, We are having some issues paying with our credit card',
                'text'        => $text = 'Hey there,<br /><br />We are having some issues paying with our credit card, can you temporarily reactivate our service and we will pay as soon as we can.<br /><br />Thanks,<br />Jane',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 87600,
                'updated_at'  => $time - 87600
            ],
            [
                'ticket_id'   => $ticket4,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::operator()->firstOrFail()->id,
                'user_name'   => User::operator()->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 0,
                'type'        => 1,
                'excerpt'     => 'Hi Jane, No worries I\'ve just reactivated the service and we can give you 5 days',
                'text'        => $text = 'Hi Jane,<br /><br />No worries I\'ve just reactivated the service and we can give you 5 days to complete payment. I hope this is enough time, but let me know if you run in to any further trouble with it.<br /><br />-----<br />Best Regards,<br /><br />John Doe<br /><strong>Demo</strong>',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 87100,
                'updated_at'  => $time - 87100
            ],
            [
                'ticket_id'   => $ticket4,
                'channel_id'  => Channel::where('name', 'API')->firstOrFail()->id,
                'user_id'     => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->id,
                'user_name'   => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 1,
                'type'        => 0,
                'excerpt'     => 'Thanks! I managed to pay with another card, so you can close this ticket. Jane',
                'text'        => $text = 'Thanks! I managed to pay with another card, so you can close this ticket. <br /><br />Jane',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 86650,
                'updated_at'  => $time - 86650
            ],
            [
                'ticket_id'   => $ticket5,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::where('email', 'user@demo.com')->firstOrFail()->id,
                'user_name'   => User::where('email', 'user@demo.com')->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 1,
                'type'        => 0,
                'excerpt'     => 'Hi there, I thought it would be a nice additional feature to allow admins to set up two',
                'text'        => $text = 'Hi there,<br /><br />I thought it would be a nice additional feature to allow admins to set up two factor authentication (2FA) on their accounts for added security. You can integrate google authenticator and it will work with almost any mobile device with internet. What do you think?<br /><br />Patrick',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 7400,
                'updated_at'  => $time - 7400
            ],
            [
                'ticket_id'   => $ticket5,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::operator()->firstOrFail()->id,
                'user_name'   => User::operator()->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 0,
                'type'        => 0,
                'excerpt'     => 'Hi Patrick, Great idea! I\'ve logged this in our development tracker.',
                'text'        => $text = 'Hi Patrick,<br /><br />Great idea! I\'ve logged this in our development tracker. There are some premium solutions available, or do you think Google Authenticator is the best option out there?<br /><br />-----<br />Best Regards,<br /><br />John Doe<br /><strong>Demo</strong>',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 6800,
                'updated_at'  => $time - 6800
            ],
            [
                'ticket_id'   => $ticket6,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::operator()->where('email', 'operator2@demo.com')->firstOrFail()->id,
                'user_name'   => User::operator()->where('email', 'operator2@demo.com')->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 0,
                'type'        => 0,
                'excerpt'     => 'John - one of the hard drive is showing a warning light, can you order a new drive',
                'text'        => $text = 'John - one of the hard drive is showing a warning light, can you order a new drive and let me know when it arrives.',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 2804,
                'updated_at'  => $time - 2804
            ],
            [
                'ticket_id'   => $ticket6,
                'channel_id'  => Channel::where('name', 'Web')->firstOrFail()->id,
                'user_id'     => User::operator()->firstOrFail()->id,
                'user_name'   => User::operator()->firstOrFail()->formatted_name,
                'user_ip_address' => inet_pton('81.8.12.192'),
                'by'          => 0,
                'type'        => 1,
                'excerpt'     => 'New drive ordered from Amazon and should arrive this evening.',
                'text'        => $text = 'New drive ordered from Amazon and should arrive this evening.',
                'purified_text' => $text,
                'is_draft'    => 0,
                'created_at'  => $time - 100,
                'updated_at'  => $time - 100
            ],
        ]);

        // Insert custom field values
        DB::table('ticket_customfield_value')->insert([
            [
                'field_id'    => $fieldId = TicketCustomField::where('name', 'Installed Version')->firstOrFail()->id,
                'ticket_id'   => $ticket1,
                'value'       => TicketCustomFieldValue::where('field_id', $fieldId)->where('value', '2.0.2')->firstOrFail()->id,
                'encrypted'   => 0,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'field_id'    => TicketCustomField::where('name', 'Installation URL')->firstOrFail()->id,
                'ticket_id'   => $ticket1,
                'value'       => 'http://mydomain.com/support',
                'encrypted'   => 0,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'field_id'    => TicketCustomField::where('name', 'FTP Username')->firstOrFail()->id,
                'ticket_id'   => $ticket1,
                'value'       => Crypt::encrypt('myusername'),
                'encrypted'   => 1,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'field_id'    => TicketCustomField::where('name', 'FTP Password')->firstOrFail()->id,
                'ticket_id'   => $ticket1,
                'value'       => Crypt::encrypt('mypassword'),
                'encrypted'   => 1,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Assign operator to tickets
        DB::table('ticket_operator_membership')->insert([
            [ 'ticket_id' => $ticket1, 'user_id' => User::operator()->firstOrFail()->id ]
        ]);

        // Assign tags to tickets
        DB::table('ticket_tag_membership')->insert([
            [ 'ticket_id' => $ticket1, 'tag_id' => Tag::where('name', 'Bug')->firstOrFail()->id ],
            [ 'ticket_id' => $ticket3, 'tag_id' => Tag::where('name', 'Custom Work')->firstOrFail()->id ],
            [ 'ticket_id' => $ticket5, 'tag_id' => Tag::where('name', 'Feature Request')->firstOrFail()->id ],
            [ 'ticket_id' => $ticket5, 'tag_id' => Tag::where('name', 'Logged')->firstOrFail()->id ],
        ]);

        // Add viewed records
        DB::table('ticket_viewed')->insert([
            [ 'ticket_id' => $ticket1, 'user_id' => User::operator()->firstOrFail()->id, 'user_type' => 1, 'updated_at' => $time - 1000 ],
            [ 'ticket_id' => $ticket3, 'user_id' => User::operator()->firstOrFail()->id, 'user_type' => 1, 'updated_at' => $time - 1000 ],
            [ 'ticket_id' => $ticket5, 'user_id' => User::operator()->firstOrFail()->id, 'user_type' => 1, 'updated_at' => $time - 1000 ],
            [ 'ticket_id' => $ticket6, 'user_id' => User::operator()->firstOrFail()->id, 'user_type' => 1, 'updated_at' => $time - 1000 ],
        ]);

        DB::table('activity_log')->insert([
            [
                'type'          => 2,
                'rel_name'      => '5872912',
                'rel_id'        => $ticket1,
                'rel_route'     => 'ticket.operator.ticket.show',
                'section'       => 'ticket.ticket',
                'user_id'       => User::where('email', 'joe@bloggs.corp')->firstOrFail()->id,
                'user_name'     => User::where('email', 'joe@bloggs.corp')->firstOrFail()->formatted_name,
                'event_name'    => 'ticket_opened',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time - 3600,
                'updated_at'    => $time - 3600
            ],
            [
                'type'          => 2,
                'rel_name'      => 'SALES-63959',
                'rel_id'        => $ticket2,
                'rel_route'     => 'ticket.operator.ticket.show',
                'section'       => 'ticket.ticket',
                'user_id'       => User::where('email', 'bklein@echo.xyz')->firstOrFail()->id,
                'user_name'     => User::where('email', 'bklein@echo.xyz')->firstOrFail()->formatted_name,
                'event_name'    => 'ticket_opened',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'type'          => 2,
                'rel_name'      => '7483029',
                'rel_id'        => $ticket3,
                'rel_route'     => 'ticket.operator.ticket.show',
                'section'       => 'ticket.ticket',
                'user_id'       => User::where('email', 'andersonc@myemail.com')->firstOrFail()->id,
                'user_name'      => User::where('email', 'andersonc@myemail.com')->firstOrFail()->formatted_name,
                'event_name'    => 'ticket_opened',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time - 10400,
                'updated_at'    => $time - 10400
            ],
            [
                'type'          => 2,
                'rel_name'      => 'SALES-03139',
                'rel_id'        => $ticket4,
                'rel_route'     => 'ticket.operator.ticket.show',
                'section'       => 'ticket.ticket',
                'user_id'       => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->id,
                'user_name'     => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->formatted_name,
                'event_name'    => 'ticket_opened',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time - 87600,
                'updated_at'    => $time - 87600
            ],
            [
                'type'          => 2,
                'rel_name'      => '1354619',
                'rel_id'        => $ticket5,
                'rel_route'     => 'ticket.operator.ticket.show',
                'section'       => 'ticket.ticket',
                'user_id'     => User::where('email', 'user@demo.com')->firstOrFail()->id,
                'user_name'   => User::where('email', 'user@demo.com')->firstOrFail()->formatted_name,
                'event_name'    => 'ticket_opened',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time - 7400,
                'updated_at'    => $time - 7400
            ],
            [
                'type'          => 1,
                'rel_name'      => '9594392',
                'rel_id'        => $ticket6,
                'rel_route'     => 'ticket.operator.ticket.show',
                'section'       => 'ticket.ticket',
                'user_id'       => User::operator()->where('email', 'operator2@demo.com')->firstOrFail()->id,
                'user_name'     => User::operator()->where('email', 'operator2@demo.com')->firstOrFail()->formatted_name,
                'event_name'    => 'ticket_opened',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time - 2804,
                'updated_at'    => $time - 2804
            ]
        ]);
    }
}

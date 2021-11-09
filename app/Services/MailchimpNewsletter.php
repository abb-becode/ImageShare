<?php

	namespace App\Services;

    use MailchimpMarketing\ApiClient;

	class MailchimpNewsletter implements Newsletter
	{
        public function __construct(protected ApiClient $client)
        {
            //
        }

        // Subscribe to a newsletter
        public function subscribe(string $email, string $list = null)
        {
            // Null safe assignment
            // $list is equal what parameter you give or what define in a config file
            $list ??= config('services.mailchimp.lists.subscribers');

            /*return $this->client()->lists->addListMember($list, [
                'email_address' => $email,
                'status' => 'subscribed'
            ]);*/
            return $this->client->lists->addListMember($list, [
                'email_address' => $email,
                'status' => 'subscribed'
            ]);
        }

        /*protected function client()
        {
            return $this->client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us5'
            ]);
        }*/

        // Unsubscribe from a newsletter
	}

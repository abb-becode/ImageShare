<?php

    namespace App\Http\Controllers;

    //use App\Services\MailchimpNewsletter;
    use App\Services\Newsletter;
    use Exception;
    use Illuminate\Validation\ValidationException;
    use Illuminate\Http\Request;

    class NewsletterController extends Controller
    {

        //public function __invoke(MailchimpNewsletter $newsletter)
        public function __invoke(Newsletter $newsletter)
        {
            //ddd($newsletter);

            request()->validate(['email' => 'required|email']);

            try {
                $newsletter->subscribe(request('email'));
            } catch (Exception $e) {
                throw ValidationException::withMessages([
                    'email' => 'This email could not be added to our newsletter list.'
                ]);
            }

            return redirect('/')
                ->with('success', 'You are now signed up for our newsletter');
        }
    }

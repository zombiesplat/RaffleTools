<?php

namespace App\Providers;

use App\User;
use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Raffle Tools',
        'product' => 'Online Raffle Management',
        'street' => 'PO Box 111',
        'location' => 'Phoenix, AZ 85001',
        'phone' => '602-555-5555',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = 'support@raffletools.org';

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        //
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    public function register()
    {
        Spark::referToTeamAs('organization');
    }

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
//        Spark::useBraintree()->noCardUpFront()->teamTrialDays(10);
        Spark::useStripe()->noCardUpFront()->teamTrialDays(10);

        Spark::useRoles(User::ROLES);

        Spark::freeTeamPlan('Introductory')
            ->features([
                'Single Raffle Item',
                'Single Winner',
                'Single Drawing',
            ]);

        Spark::teamPlan('Basic', 'basic_plan')
            ->price(10)
            ->features([
                '10 Items',
                '10 Winners',
                'Door prize drawing',
            ]);

        Spark::teamPlan('More Features Plan', 'more_plan')
            ->price(50)
            ->features([
                'Unlimited Items',
                'Unlimited Winners',
                'Door prize drawing',
                '50/50 drawing',
                'cashier drawer?'
            ]);
    }
}

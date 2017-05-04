<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'photo_url' => '//randomuser.me/api/portraits/'.(random_int(0, 1) ? 'men' : 'women').'/'.random_int(0,99).'.jpg',
    ];
});

$factory->define(App\Team::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'photo_url' => $faker->imageUrl(640, 480, 'people'),
    ];
});

$factory->define(App\Model\Event::class, function (Faker\Generator $faker) {
    $open_date_time = $faker->dateTimeBetween('now', '+1 month');
    return [
        'name' => $faker->randomElement(['Charity Dinner', 'Silent Auction', 'Benefit Event']),
        'type' => $faker->randomElement(['online', 'irl', 'hybrid']),
        'description' => $faker->paragraph(),
        'location_name' => $faker->company,
        'location_address' => $faker->address,
        'contact_name' => $faker->name,
        'contact_email' => $faker->safeEmail,
        'contact_phone' => $faker->phoneNumber,
        'open_date_time' => $open_date_time, //->format('Y-m-d H:i:s')
        'drawing_date_time' => $open_date_time->add(new DateInterval('P'.$faker->numberBetween(1,20).'D')),
        'terms_and_conditions' => '',
    ];
});

$factory->define(App\Model\Item::class, function (Faker\Generator $faker) {
    $cost = $faker->numberBetween(0, 200000);
    $value_markup = $faker->numberBetween(0, 200000);
    return [
        'type' => $faker->randomElement(['raffle', '50_50', 'door_prize']),
        'name' => implode(' ', $faker->words($faker->numberBetween(1, 3))),
        'description' => $faker->paragraph(),
        'image' => $faker->imageUrl(640, 480, $faker->randomElement(['transport', 'animals', 'technics', 'fashion', 'business'])),
        'cost' => $cost,
        'value' => $cost + $value_markup,
        'sponsor' => $faker->company,
    ];
});

$factory->define(App\Model\Ticket::class, function (Faker\Generator $faker) {
    $token = $faker->numberBetween(100000, 200000);
    return [
        'token' => $token,
    ];
});

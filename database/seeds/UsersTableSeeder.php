<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Team;
use App\Model\Event;
use App\Model\Item;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::unguard();
        Team::unguard();
        Event::unguard();
        Item::unguard();

        $this->command->info("Truncating users table");
        User::truncate();

        $this->command->info("Truncating teams table");
        Team::truncate();

        $this->command->info("Truncating events table");
        Event::truncate();

        $this->command->info("Truncating items table");
        Item::truncate();

        $this->command->info("Truncating team_users table");
        DB::table('team_users')->truncate();

        factory(User::class)->times(10)->create([])->each(function($user) {
            /** @var User $user */
            factory(Team::class)->times(1)->create(['owner_id' => $user->id])->each(function($team) use ($user) {
                /** @var Team $team */
                $team->users()->attach($user, ['role' => 'owner']);
                factory(User::class)->times(random_int(3, 8))->create([])->each(function($team_user) use($team) {
                    $team->users()->attach($team_user, [
                        'role' => array_keys(User::ROLES)[random_int(0, count(User::ROLES) - 1)]
                    ]);
                });
                factory(Event::class)->times(random_int(2, 5))->create(['team_id' => $team->id])->each(function($event) use($team) {
                    factory(Item::class)->times(random_int(4, 20))->create(['event_id' => $event->id]);
                });
            });
        });


        User::reguard();
        Team::reguard();
        Event::reguard();
        Item::reguard();
    }
}

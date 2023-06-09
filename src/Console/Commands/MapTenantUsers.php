<?php

namespace ReesMcIvor\Auth\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use ReesMcIvor\Auth\Models\TenantUser;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use Stancl\Tenancy\Concerns\HasATenantArgument;
use Stancl\Tenancy\Concerns\TenantAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Models\User;

class MapTenantUsers extends Command {

    protected $name = 'tenants:users:map';
    protected $description = 'Map all users to central';

    use TenantAwareCommand;

    public function getTenants()
    {
        return Tenant::all();
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $users = [];

        Tenant::all()->each(function($tenant) {
            $tenant->run(function() use ($tenant, &$users) {
                $users = User::all()->map(fn($user) => [
                    'user_id' => $user->id,
                    'tenant_id' => $tenant->id,
                    'email' => $user->email
                ]);
            });
            TenantUser::insert($users->toArray());
            tenancy()->end();
        });

        return Command::SUCCESS;

    }

}

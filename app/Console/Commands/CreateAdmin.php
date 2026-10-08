<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'cms:admin {email} {--name=Administrator} {--generate-local : Generate a random password on a local environment}';

    protected $description = 'Create an administrator using a securely prompted password';

    public function handle(): int
    {
        $email = $this->argument('email');
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Enter a valid email.');

            return 1;
        }
        if (User::where('email', $email)->exists()) {
            $this->error('Account already exists; no changes made.');

            return 1;
        }
        if ($this->option('generate-local') && ! app()->environment('local')) {
            $this->error('Generated credentials are for local use only.');

            return 1;
        }
        $password = $this->option('generate-local') ? bin2hex(random_bytes(12)) : $this->secret('Password (at least 12 characters)');
        if (strlen($password ?? '') < 12) {
            $this->error('At least 12 characters required.');

            return 1;
        }
        $user = new User;
        $user->name = $this->option('name');
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->is_admin = true;
        $user->save();
        $this->info('Administrator created.');
        if ($this->option('generate-local')) {
            $this->line('Local password: '.$password);
        }

        return 0;
    }
}

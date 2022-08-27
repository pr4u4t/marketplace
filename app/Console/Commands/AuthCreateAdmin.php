<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\User;

class AuthCreateAdmin extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:create-admin {pass} {mnemo} {ref?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin account on fresh installation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    function random_str(int $length = 64, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string {
    	if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
    	}

    	$pieces = [];
    	$max = mb_strlen($keyspace, '8bit') - 1;
	
	for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
	}

    	return implode('', $pieces);
    } 

    public function createAdminAccount($password,$mnemonic,$referral = null){
        $admin = new User();
        $admin->username = 'admin';
        $admin->password = bcrypt($password);
        $admin->mnemonic = bcrypt(hash('sha256', $mnemonic));
        $admin->login_2fa = false;
        $admin->referral_code = ($referral != null) ? $referral : $this->random_str(8);

        $adminKeyPair = new \App\Marketplace\Encryption\Keypair();
        $adminPrivateKey = $adminKeyPair->getPrivateKey();
        $adminPublicKey = $adminKeyPair->getPublicKey();
        $AdminEcnryptedPrivateKey = \Defuse\Crypto\Crypto::encryptWithPassword($adminPrivateKey, $password);

        $admin->msg_private_key = $AdminEcnryptedPrivateKey;
	$admin->msg_public_key = encrypt($adminPublicKey);
	$admin->currency = 'USD';
	$admin->jswarn = false;
        $admin->pgp_key = 'Change_me!';
        $admin->save();
        $nowTime = \Carbon\Carbon::now();
        \App\Admin::insert([
            'id' => $admin->id,
            'created_at' => $nowTime,
            'updated_at' => $nowTime
        ]);

        $this->line('Created [admin] account');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
	// if there is no admin create it
	if (User::where('username','admin')->first() == null){
	    $pass = $this->argument('pass');
	    $mnemo = $this->argument('mnemo');
	    $ref = $this->argument('ref');
            $this->line('There is no [admin] account, creating it...');
            $this->createAdminAccount($pass,$mnemo,$ref);
        } else {
            $this->error('Account [admin] is present');
	}

        return 0;
    }
}

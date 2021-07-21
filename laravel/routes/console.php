<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//Artisan::command('zzz:test', function (\App\Service\Pushall $pushall) {
//    dump($pushall);
//})->purpose('2 կամանդ');

Artisan::command('jan:davs',function () {
   $name = $this->ask('kak vam zavut?');
   $password = $this->secret('kak vash parol?');
   if ($this->confirm('vam es 18 let?'))
       $this->error('maladec');
   $food = $this->choice('ba inch kuteir hima?',['morquri mot','art lanch', 'te sev shenqi mot']);
   $this->info($name);
   $this->info($password);
   $this->info($food);

});


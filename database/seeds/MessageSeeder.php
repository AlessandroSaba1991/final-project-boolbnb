<?php

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages=config('db.messages');
        foreach ($messages as $message) {
            $new_mess = new Message();
            $new_mess->fullname = $message['fullname'];
            $new_mess->email = $message['email'];
            $new_mess->content = $message['content'];
            $new_mess->save();
        }
    }
}

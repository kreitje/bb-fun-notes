<?php

use App\User;
use Illuminate\Database\Seeder;

class DemoUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User;
        $user->name = 'Demo User';
        $user->email = 'demo@demo.com';
        $user->password = 'password';
        $user->save();
        
        $this->createNotes($user);
    }

    private function createNotes(User $user)
    {
        $note = new \App\Notes\Note;
        $note->user_id = $user->id;
        $note->note = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).';
        $note->width = 100;
        $note->height = 100;
        $note->color = 'red';
        $note->save();

        $note = new \App\Notes\Note;
        $note->user_id = $user->id;
        $note->note = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
        $note->width = 100;
        $note->height = 100;
        $note->color = 'orange';
        $note->save();
    }
}

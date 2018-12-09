<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */

    function an_authenticated_user_may_participate_in_forum_threads()
    {

        $user = factory('App\User')->create();
        $this->be($user);
        
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();
        
        $this->post('/threads/' .$thread->id . '/replies', $reply->toArray()); 

        $this->get($thread->path())
            ->assertSee($reply->body);

    }

}

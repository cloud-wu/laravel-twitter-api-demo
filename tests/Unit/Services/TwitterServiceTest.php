<?php

namespace Tests\Unit\Services;

use App\Entities\Token;
use App\Entities\User;
use App\Foundation\Fakers\Twitter as FakerTwitter;
use App\Services\TwitterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Foundation\Twitter\Twitter;

class TwitterServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker->addProvider($this->app->make(FakerTwitter::class));

        $user = factory(User::class)->create();
        $user->tokens()->save(factory(Token::class)->make());
        $this->actingAs($user);
    }

    /**
     * @test
     * @group TwitterService
     */
    public function it_could_post_tweet()
    {
        $postText = 'hi';

        $this->mock(Twitter::class, function ($mock) use ($postText) {
            $mock->shouldReceive('credential')->once();
            $mock->shouldReceive('postTweet')
                ->once()
                ->andReturn($this->faker->twitterPostTweetResponse(['text' => $postText]));
        });

        $this->app->make(TwitterService::class)->postTweet($postText);

        $this->assertDatabaseHas('tweets', [
            'text' => $postText
        ]);
    }
}

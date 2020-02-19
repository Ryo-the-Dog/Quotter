<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }



    public function setUp(): void
    {
        echo 'ログイン中のユーザーを返却する';
        parent::setUp();

        // テストユーザー作成
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function should_ログイン中のユーザーを返却する()
    {
        echo 'ログイン中のユーザーを返却する';
        $response = $this->actingAs($this->user)->json('GET', route('user')); // TODO POSTに変えてもだめ

        $response->assertStatus(200)->assertJson(['name' => $this->user->name]);
        // $this->assertGuest();
    }

    /**
     * @test
     */
    public function should_ログインされていない場合は空文字を返却する()
    {
        echo 'ログインされていない場合は空文字を返却する';
        $response = $this->json('GET', route('user'));

        $response->assertStatus(200);
        $this->assertEquals("", $response->content());
    }

}

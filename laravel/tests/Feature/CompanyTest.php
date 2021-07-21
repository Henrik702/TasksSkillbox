<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAUserCanCreateACompany()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $this->post('/companies', $attributes = ['name' => 'Qsoft']);

        $this->assertDatabaseHas('companies', $attributes);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Airline;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AirlineApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('airlines');
        Schema::create('airlines', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->timestamps();
        });
    }

    public function test_airline_crud_endpoints_work(): void
    {
        $airline = Airline::factory()->create();

        $this->getJson('/api/airlines')
            ->assertOk()
            ->assertJsonFragment(['id' => $airline->id, 'name' => $airline->name]);

        $this->getJson('/api/airlines/'.$airline->id)
            ->assertOk()
            ->assertJsonPath('id', $airline->id);

        $this->putJson('/api/airlines/'.$airline->id, [
            'name' => 'Updated Airline',
        ])->assertOk()->assertJsonPath('name', 'Updated Airline');

        $this->assertDatabaseHas('airlines', [
            'id' => $airline->id,
            'name' => 'Updated Airline',
        ]);

        $this->deleteJson('/api/airlines/'.$airline->id)->assertNoContent();
        $this->assertDatabaseMissing('airlines', ['id' => $airline->id]);
    }

    public function test_create_edit_and_store_endpoints_work(): void
    {
        $this->getJson('/api/airlines/create')
            ->assertOk()
            ->assertExactJson(['name' => null, 'country' => null]);

        $response = $this->postJson('/api/airlines', [
            'name' => 'Northwind Air',
            'country' => 'Canada',
        ]);

        $response->assertCreated()
            ->assertJsonPath('name', 'Northwind Air')
            ->assertJsonPath('country', 'Canada');

        $airlineId = $response->json('id');

        $this->getJson('/api/airlines/'.$airlineId.'/edit')
            ->assertOk()
            ->assertJsonPath('name', 'Northwind Air');

        $this->postJson('/api/airlines', ['name' => 'Missing Country'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('country');
    }
}

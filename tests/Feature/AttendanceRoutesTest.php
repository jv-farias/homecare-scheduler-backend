<?php

namespace Tests\Feature;

use App\Models\Attendance;
use Tests\TestCase;

class AttendanceRoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/attendances');

        $response->assertStatus(200);
    }

    public function test_store_route_creates_attendance()
    {
        $payload = [
            'name' => 'Alisson Renan',
            'phone' => '85987654321',
            'address' => 'Rua Abc, 123, Centro, Fortaleza',
            'request_reason' => 'general_consultation',
            'symptoms' => 'Alguns sintomas quaisquer',
            'status' => 'pending',
        ];

        $response = $this->postJson('/api/attendances', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'name' => 'Alisson Renan',
                    'phone' => '85987654321',
                    'address' => 'Rua Abc, 123, Centro, Fortaleza',
                    'request_reason' => 'general_consultation',
                    'symptoms' => 'Alguns sintomas quaisquer',
                    'status' => 'pending',
                ],
            ]);

        $this->assertDatabaseHas('attendances', ['name' => 'Alisson Renan']);
    }

    public function test_metrics_route_returns_metrics()
    {
        Attendance::factory()->count(5)->create();

        $response = $this->getJson('/api/attendances/metrics');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'total',
                    'today',
                    'completed',
                    'pending',
                ],
                'errors',
            ]);
    }

    public function test_update_route_updates_attendance()
    {
        $attendance = Attendance::factory()->create();

        $payload = [
            'name' => 'Updated Name',
            'phone' => '85987654321',
            'address' => 'Updated Address',
            'request_reason' => 'fever_symptoms',
            'symptoms' => 'Updated symptoms',
        ];

        $response = $this->putJson("/api/attendances/{$attendance->id}", $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $attendance->id,
                    'name' => 'Updated Name',
                ],
            ]);

        $this->assertDatabaseHas('attendances', ['id' => $attendance->id, 'name' => 'Updated Name']);
    }

    public function test_show_route_returns_attendance()
    {
        $attendance = Attendance::factory()->create();

        $response = $this->getJson("/api/attendances/{$attendance->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $attendance->id,
                    'name' => $attendance->name,
                    'phone' => $attendance->phone,
                    'address' => $attendance->address,
                    'request_reason' => $attendance->request_reason,
                ],
            ]);
    }
}

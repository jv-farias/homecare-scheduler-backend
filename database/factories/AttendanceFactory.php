<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition()
    {
        // Defina os possíveis status e motivos conforme suas restrições
        $statuses = ['pending', 'completed', 'assigned', 'cancelled'];
        $requestReasons = ['general_consultation', 'fever_symptoms', 'trauma_injury', 'cardiac_emergency', 'respiratory_problem', 'other'];

        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->numerify('(##) #####-####'),
            'address' => $this->faker->address,
            // Exemplo: Gere um número de protocolo como uma string numérica
            'protocol_number' => $this->faker->numerify('############'),
            'status' => $this->faker->randomElement($statuses),
            'request_reason' => $this->faker->randomElement($requestReasons),
            'symptoms' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}

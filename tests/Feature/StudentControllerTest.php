<?php

namespace Tests\Feature;

use App\Events\NewUserRegistered;
use App\Mail\NewUserRegisteredEmail;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\StudentControllerTest as BaseTestCase;


// to Run test : php artisan test --testsuite=Feature --filter=StudentControllerTest


class StudentControllerTest extends ExampleTest
{
    use RefreshDatabase;

    public function testNewUserRegistration()
    {
        // Disable event listeners for the NewUserRegistered event
        Event::fake();

        // Disable email sending
        Mail::fake();

        // Create a student record with dummy data
        $studentData = [
            'fullName' => 'John Doe',
            'username' => 'johndoe',
            'birthDate' => '1990-01-01',
            'address' => '123 Main St',
            'phone' => '123456789',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
        ];

        $response = $this->post(route('students.store'), $studentData);

        // Assert that the student was saved to the database
        $this->assertDatabaseHas('students', [
            'Full_name' => 'John Doe',
            'Username' => 'johndoe',
            'Email' => 'johndoe@example.com',
        ]);

        // Assert that the NewUserRegistered event was fired
        Event::assertDispatched(NewUserRegistered::class, function ($event) {
            return $event->student->Username === 'johndoe';
        });

        // Assert that the NewUserRegistered email was not sent
        Mail::assertNotSent(NewUserRegisteredEmail::class);

        // Assert that the user is redirected to the students index page
        $response->assertRedirect(route('students.index'))
            ->assertSessionHas('success', 'Student Added successfully.');
    }
}

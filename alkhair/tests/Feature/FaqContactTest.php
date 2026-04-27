<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FaqContactTest extends TestCase
{
    public function test_faq_page_can_be_accessed()
    {
        $response = $this->get('/faq');
        $response->assertStatus(200);
        $response->assertSee('Questions Fréquentes');
    }

    public function test_contact_page_can_be_accessed()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Contactez-nous');
    }

    public function test_contact_form_validation_works()
    {
        $response = $this->post('/contact', []);
        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_contact_form_can_be_submitted()
    {
        $response = $this->post('/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message with more than 10 characters.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }
}

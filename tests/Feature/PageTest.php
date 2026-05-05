<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class PageTest extends TestCase {
    use RefreshDatabase;
    public function test_home_page_returns_200(): void { $this->get('/')->assertStatus(200); }
    public function test_a_propos_returns_200(): void { $this->get('/a-propos')->assertStatus(200); }
    public function test_criteres_returns_200(): void { $this->get('/criteres')->assertStatus(200); }
    public function test_contact_returns_200(): void { $this->get('/contact')->assertStatus(200); }
    public function test_admin_login_returns_200(): void { $this->get('/admin/login')->assertStatus(200); }
    public function test_admin_dashboard_redirects_without_auth(): void { $this->get('/admin')->assertRedirect('/admin/login'); }
}

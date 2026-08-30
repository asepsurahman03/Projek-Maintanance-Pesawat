<?php

namespace Tests\Feature;

use Tests\TestCase;

class ManualRoutesTest extends TestCase
{
    public function test_dashboard_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_manual_index_loads(): void
    {
        $response = $this->get('/manual');
        $response->assertStatus(200);
    }

    public function test_manual_section_loads(): void
    {
        $response = $this->get('/manual/section/01');
        $response->assertStatus(200);
    }

    public function test_manual_page_viewer_loads(): void
    {
        $response = $this->get('/manual/page/1');
        $response->assertStatus(200);
    }

    public function test_search_loads(): void
    {
        $response = $this->get('/search?q=engine');
        $response->assertStatus(200);
    }

    public function test_specifications_loads(): void
    {
        $response = $this->get('/specifications');
        $response->assertStatus(200);
    }

    public function test_aircraft_models_loads(): void
    {
        $response = $this->get('/models');
        $response->assertStatus(200);
    }

    public function test_serial_lookup(): void
    {
        $response = $this->get('/models/lookup?serial=17265522');
        $response->assertStatus(200);
        $response->assertJson(['found' => true]);
    }

    public function test_inspection_loads(): void
    {
        $response = $this->get('/inspection');
        $response->assertStatus(200);
    }

    public function test_systems_loads(): void
    {
        $response = $this->get('/systems');
        $response->assertStatus(200);
    }

    public function test_system_detail_loads(): void
    {
        $response = $this->get('/systems/engine');
        $response->assertStatus(200);
    }

    public function test_figures_loads(): void
    {
        $response = $this->get('/figures');
        $response->assertStatus(200);
    }

    public function test_wiring_loads(): void
    {
        $response = $this->get('/wiring');
        $response->assertStatus(200);
    }

    public function test_torque_values_loads(): void
    {
        $response = $this->get('/torque-values');
        $response->assertStatus(200);
    }

    public function test_admin_login_loads(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }
}

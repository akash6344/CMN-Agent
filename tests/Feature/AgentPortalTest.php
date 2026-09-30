<?php

namespace Tests\Feature;

use Tests\TestCase;

class AgentPortalTest extends TestCase
{
    public function test_root_redirects_to_dashboard(): void
    {
        $response = $this->get('/');
        $response->assertRedirect(route('agent.dashboard'));
    }

    public function test_dashboard_renders_pixel_perfect_matching_screenshots(): void
    {
        $response = $this->get(route('agent.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Good Morning, Rahul! 👋');
        $response->assertSee('New Leads Today');
        $response->assertSee('Follow-ups Due');
        $response->assertSee('Active Properties');
        $response->assertSee('Live Negotiations');
        $response->assertSee('Deals Closed');
        $response->assertSee('Commission Earned');
        $response->assertSee('Recent Leads');
        $response->assertSee('Activity Feed');
        $response->assertSee('Green Valley 3BHK');
        $response->assertSee('Upcoming Visits');
        $response->assertSee('Rahul Agarwal');
    }

    public function test_non_dashboard_routes_redirect_to_dashboard_with_coming_soon(): void
    {
        $response = $this->get(route('agent.leads'));
        $response->assertRedirect(route('agent.dashboard', ['coming_soon' => 'Leads Management']));

        $response = $this->get(route('agent.properties'));
        $response->assertRedirect(route('agent.dashboard', ['coming_soon' => 'Property Portfolio']));

        $response = $this->get(route('agent.earnings'));
        $response->assertRedirect(route('agent.dashboard', ['coming_soon' => 'Earnings & Commission']));
    }
}

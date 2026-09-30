<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Support\DemoAgentData;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function dashboard(Request $request)
    {
        $comingSoonSection = $request->query('coming_soon');

        return view('agent.dashboard', [
            'agent' => DemoAgentData::agent(),
            'navItems' => DemoAgentData::navItems(),
            'footNavItems' => DemoAgentData::footNavItems(),
            'active' => 'dashboard',
            'pageTitle' => 'Agent Dashboard',
            'pageSub' => "Here's what's happening with your leads and deals today.",
            'stats' => DemoAgentData::dashboardStats(),
            'recentLeads' => DemoAgentData::recentLeads(),
            'activityFeed' => DemoAgentData::activityFeed(),
            'liveNegotiations' => DemoAgentData::liveNegotiations(),
            'upcomingVisits' => DemoAgentData::upcomingVisits(),
            'comingSoonSection' => $comingSoonSection,
        ]);
    }

    public function comingSoon(string $section)
    {
        return redirect()->route('agent.dashboard', ['coming_soon' => ucfirst($section)]);
    }
}

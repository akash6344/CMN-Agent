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

    public function leads(Request $request)
    {
        return view('agent.leads', [
            'agent' => DemoAgentData::agent(),
            'navItems' => DemoAgentData::navItems(),
            'footNavItems' => DemoAgentData::footNavItems(),
            'active' => 'leads',
            'pageTitle' => 'Lead Management',
            'pageSub' => 'Track and manage your assigned leads',
            'leads' => DemoAgentData::leadsList(),
        ]);
    }

    public function properties(Request $request)
    {
        return view('agent.properties', [
            'agent' => DemoAgentData::agent(),
            'navItems' => DemoAgentData::navItems(),
            'footNavItems' => DemoAgentData::footNavItems(),
            'active' => 'properties',
            'pageTitle' => 'Property Portfolio',
            'pageSub' => 'Manage your assigned properties',
            'properties' => DemoAgentData::propertiesList(),
        ]);
    }

    public function earnings(Request $request)
    {
        $earningsData = DemoAgentData::earningsData();

        return view('agent.earnings', [
            'agent' => DemoAgentData::agent(),
            'navItems' => DemoAgentData::navItems(),
            'footNavItems' => DemoAgentData::footNavItems(),
            'active' => 'earnings',
            'pageTitle' => 'Earnings & Commission',
            'pageSub' => 'Track your deals and payouts',
            'stats' => $earningsData['stats'],
            'chart' => $earningsData['chart'],
            'summary' => $earningsData['summary'],
            'transactions' => $earningsData['transactions'],
        ]);
    }

    public function comingSoon(string $section)
    {
        return redirect()->route('agent.dashboard', ['coming_soon' => ucfirst($section)]);
    }
}

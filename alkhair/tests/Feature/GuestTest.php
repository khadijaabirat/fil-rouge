<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Donation;
use App\Models\ImpactReport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    protected Category $category;
    protected User $association;
    protected Project $project;
    protected Project $closedProject;
    protected ImpactReport $impactReport;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create(['name' => 'Education']);

        $this->association = User::factory()->create([
            'role'        => 'association',
            'status'      => 'ACTIVE',
            'category_id' => $this->category->id,
        ]);

        $this->project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id'    => $this->category->id,
            'status'         => 'OPEN',
            'goalAmount'     => 10000,
            'currentAmount'  => 4000,
            'title'          => 'Projet Test Visiteur',
        ]);

        $this->closedProject = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id'    => $this->category->id,
            'status'         => 'COMPLETED',
            'goalAmount'     => 5000,
            'currentAmount'  => 5000,
        ]);

        $this->impactReport = ImpactReport::factory()->create([
            'project_id' => $this->closedProject->id,
        ]);
    }

    // ─── PAGE D'ACCUEIL ───────────────────────────────────────────────────────

    public function test_guest_can_access_home_page()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    public function test_home_page_shows_statistics()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewHas('totalCollected');
        $response->assertViewHas('verifiedAssociations');
        $response->assertViewHas('completedProjects');
        $response->assertViewHas('categories');
        $response->assertViewHas('projects');
        $response->assertViewHas('impactReports');
    }

    public function test_home_page_search_by_keyword()
    {
        $response = $this->get(route('home', ['search' => 'Projet Test']));

        $response->assertStatus(200);
        $response->assertViewHas('projects');
    }

    public function test_home_page_filter_by_category()
    {
        $response = $this->get(route('home', ['category' => $this->category->id]));

        $response->assertStatus(200);
        $response->assertViewHas('projects');
    }

    // ─── LISTE DES PROJETS ────────────────────────────────────────────────────

    public function test_guest_can_access_projects_index()
    {
        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);
        $response->assertViewIs('projects.index');
        $response->assertViewHas('projects');
        $response->assertViewHas('categories');
    }

    public function test_projects_index_shows_project_title()
    {
        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);
        $response->assertSee($this->project->title);
    }

    public function test_projects_index_search_filter()
    {
        $response = $this->get(route('projects.index', ['search' => 'Projet Test Visiteur']));

        $response->assertStatus(200);
        $response->assertSee($this->project->title);
    }

    public function test_projects_index_category_filter()
    {
        $response = $this->get(route('projects.index', ['category_id' => $this->category->id]));

        $response->assertStatus(200);
        $response->assertViewHas('projects');
    }

    public function test_projects_index_sort_filter()
    {
        $response = $this->get(route('projects.index', ['sort' => 'latest']));

        $response->assertStatus(200);
    }

    // ─── DÉTAIL D'UN PROJET ───────────────────────────────────────────────────

    public function test_guest_can_view_project_detail()
    {
        $response = $this->get(route('projects.show', $this->project->id));

        $response->assertStatus(200);
        $response->assertViewIs('projects.show');
        $response->assertViewHas('project');
        $response->assertViewHas('canDonate');
    }

    public function test_project_detail_shows_correct_data()
    {
        $response = $this->get(route('projects.show', $this->project->id));

        $response->assertStatus(200);
        $response->assertSee($this->project->title);
        $response->assertSee($this->association->name);
    }

    public function test_open_project_can_donate_is_true()
    {
        $response = $this->get(route('projects.show', $this->project->id));

        $response->assertStatus(200);
        $response->assertViewHas('canDonate', true);
    }

    public function test_completed_project_can_donate_is_false()
    {
        $response = $this->get(route('projects.show', $this->closedProject->id));

        $response->assertStatus(200);
        $response->assertViewHas('canDonate', false);
    }

    public function test_project_detail_returns_404_for_invalid_id()
    {
        $response = $this->get(route('projects.show', 99999));

        $response->assertStatus(404);
    }

    // ─── IMPACT REPORTS ───────────────────────────────────────────────────────

    public function test_guest_can_access_impact_index()
    {
        $response = $this->get(route('impact.index'));

        $response->assertStatus(200);
        $response->assertViewIs('impact.indeximpact');
        $response->assertViewHas('impactReports');
    }

    public function test_impact_index_search_filter()
    {
        $response = $this->get(route('impact.index', ['search' => 'test']));

        $response->assertStatus(200);
        $response->assertViewHas('impactReports');
    }

    public function test_guest_can_view_impact_report_detail()
    {
        $response = $this->get(route('impact.show', $this->impactReport->id));

        $response->assertStatus(200);
        $response->assertViewIs('impact.showimpact');
        $response->assertViewHas('impactReport');
        $response->assertViewHas('project');
    }

    public function test_impact_report_detail_shows_project_title()
    {
        $response = $this->get(route('impact.show', $this->impactReport->id));

        $response->assertStatus(200);
        $response->assertSee($this->closedProject->title);
    }

    public function test_impact_report_detail_returns_404_for_invalid_id()
    {
        $response = $this->get(route('impact.show', 99999));

        $response->assertStatus(404);
    }

    public function test_guest_can_download_impact_report_pdf()
    {
        $response = $this->get(route('impact.pdf', $this->impactReport->id));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    // ─── REDIRECTIONS PROTÉGÉES ───────────────────────────────────────────────

    public function test_guest_cannot_access_admin_dashboard()
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_association_dashboard()
    {
        $response = $this->get(route('association.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_donator_dashboard()
    {
        $response = $this->get(route('donator.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_donation_form()
    {
        $response = $this->get(route('donations.create', $this->project->id));

        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_create_project_form()
    {
        $response = $this->get(route('projects.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_submit_donation()
    {
        $response = $this->post(route('donations.store', $this->project->id), [
            'amount' => 500,
        ]);

        $response->assertRedirect(route('login'));
    }

    // ─── AUTHENTIFICATION ─────────────────────────────────────────────────────

    public function test_guest_can_access_login_page()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function test_guest_can_access_register_page()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    public function test_guest_can_login_as_donator()
    {
        $donator = User::factory()->create([
            'role'     => 'donator',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email'    => $donator->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($donator);
    }

    public function test_guest_cannot_login_with_wrong_password()
    {
        $donator = User::factory()->create([
            'role'     => 'donator',
            'password' => bcrypt('correct_password'),
        ]);

        $response = $this->post(route('login'), [
            'email'    => $donator->email,
            'password' => 'wrong_password',
        ]);

        $this->assertGuest();
    }

    // ─── DONNÉES DYNAMIQUES ───────────────────────────────────────────────────

    public function test_projects_index_is_paginated()
    {
        Project::factory()->count(15)->create([
            'association_id' => $this->association->id,
            'category_id'    => $this->category->id,
            'status'         => 'OPEN',
        ]);

        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);
        // paginate(12) → max 12 par page
        $projects = $response->viewData('projects');
        $this->assertLessThanOrEqual(12, $projects->count());
    }

    public function test_impact_index_is_paginated()
    {
        ImpactReport::factory()->count(15)->create();

        $response = $this->get(route('impact.index'));

        $response->assertStatus(200);
        $reports = $response->viewData('impactReports');
        $this->assertLessThanOrEqual(12, $reports->count());
    }

    public function test_project_with_donations_shows_donors()
    {
        $donator = User::factory()->create(['role' => 'donator']);
        Donation::factory()->create([
            'project_id'  => $this->project->id,
            'donator_id'  => $donator->id,
            'status'      => 'VALIDATED',
            'isAnonymous' => false,
        ]);

        $response = $this->get(route('projects.show', $this->project->id));

        $response->assertStatus(200);
    }
}

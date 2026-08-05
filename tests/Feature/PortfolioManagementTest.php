<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_portfolio_management(): void
    {
        $this->get(route('portfolios.index'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_create_portfolio(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('portfolios.store'), [
            'title' => '顧客管理システム',
            'summary' => 'Laravelによる管理画面とAPIの設計・実装',
            'year' => 2026,
            'business_category' => 'Webアプリ開発',
            'link_url' => 'https://example.com/portfolio',
        ]);

        $response->assertRedirect(route('portfolios.index'));
        $this->assertDatabaseHas('portfolios', [
            'title' => '顧客管理システム',
            'year' => 2026,
            'business_category' => 'Webアプリ開発',
        ]);
    }

    public function test_authenticated_user_can_update_portfolio(): void
    {
        $user = User::factory()->create();
        $portfolio = Portfolio::create($this->portfolioData());

        $response = $this->actingAs($user)->put(route('portfolios.update', $portfolio), [
            ...$this->portfolioData(),
            'title' => '更新後のタイトル',
            'year' => 2025,
        ]);

        $response->assertRedirect(route('portfolios.index'));
        $this->assertDatabaseHas('portfolios', [
            'id' => $portfolio->id,
            'title' => '更新後のタイトル',
            'year' => 2025,
        ]);
    }

    public function test_authenticated_user_can_delete_portfolio(): void
    {
        $user = User::factory()->create();
        $portfolio = Portfolio::create($this->portfolioData());

        $this->actingAs($user)
            ->delete(route('portfolios.destroy', $portfolio))
            ->assertRedirect(route('portfolios.index'));

        $this->assertDatabaseMissing('portfolios', ['id' => $portfolio->id]);
    }

    public function test_portfolio_is_rendered_on_public_page(): void
    {
        Portfolio::create($this->portfolioData());

        $this->get('/')
            ->assertOk()
            ->assertSee('顧客管理システム')
            ->assertSee('Laravelによる管理画面とAPIの設計・実装')
            ->assertSee('https://example.com/portfolio');
    }

    public function test_portfolio_fields_are_validated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('portfolios.store'), [
                'title' => '',
                'summary' => '',
                'year' => 99,
                'business_category' => '',
                'link_url' => 'not-a-url',
            ])
            ->assertSessionHasErrors([
                'title',
                'summary',
                'year',
                'business_category',
                'link_url',
            ]);
    }

    /** @return array<string, mixed> */
    private function portfolioData(): array
    {
        return [
            'title' => '顧客管理システム',
            'summary' => 'Laravelによる管理画面とAPIの設計・実装',
            'year' => 2026,
            'business_category' => 'Webアプリ開発',
            'link_url' => 'https://example.com/portfolio',
        ];
    }
}

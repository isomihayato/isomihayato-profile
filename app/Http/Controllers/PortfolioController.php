<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('portfolios.index', [
            'portfolios' => Portfolio::query()->latest('year')->latest('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('portfolios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Portfolio::create($this->validated($request));

        return to_route('portfolios.index')->with('status', 'ポートフォリオを登録しました。');
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $portfolio->update($this->validated($request));

        return to_route('portfolios.index')->with('status', 'ポートフォリオを更新しました。');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->delete();

        return to_route('portfolios.index')->with('status', 'ポートフォリオを削除しました。');
    }

    /** @return array<string, mixed> */
    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'summary' => ['required', 'string', 'max:500'],
            'year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:2100'],
            'business_category' => ['required', 'string', 'max:80'],
            'link_url' => ['nullable', 'url:http,https', 'max:2048'],
        ]);
    }
}

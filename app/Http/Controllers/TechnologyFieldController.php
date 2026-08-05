<?php

namespace App\Http\Controllers;

use App\Models\TechnologyField;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TechnologyFieldController extends Controller
{
    public function index(): View
    {
        return view('technology-fields.index', [
            'technologyFields' => TechnologyField::query()->withCount('experiencedTechnologies')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('technology-fields.create');
    }

    public function store(Request $request): RedirectResponse
    {
        TechnologyField::create($this->validated($request));

        return to_route('technology-fields.index')->with('status', '分野を登録しました。');
    }

    public function edit(TechnologyField $technologyField): View
    {
        return view('technology-fields.edit', compact('technologyField'));
    }

    public function update(Request $request, TechnologyField $technologyField): RedirectResponse
    {
        $technologyField->update($this->validated($request, $technologyField));

        return to_route('technology-fields.index')->with('status', '分野を更新しました。');
    }

    public function destroy(TechnologyField $technologyField): RedirectResponse
    {
        $technologyField->delete();

        return to_route('technology-fields.index')->with('status', '分野を削除しました。');
    }

    /** @return array<string, mixed> */
    private function validated(Request $request, ?TechnologyField $technologyField = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:80', Rule::unique('technology_fields')->ignore($technologyField)],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ExperiencedTechnology;
use App\Models\TechnologyField;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ExperiencedTechnologyController extends Controller
{
    public function index(): View
    {
        return view('experienced-technologies.index', [
            'technologyFields' => TechnologyField::query()->with('experiencedTechnologies')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('experienced-technologies.create', [
            'technologyFields' => TechnologyField::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        ExperiencedTechnology::create($this->validated($request));

        return to_route('experienced-technologies.index')->with('status', '経験技術を登録しました。');
    }

    public function edit(ExperiencedTechnology $experiencedTechnology): View
    {
        return view('experienced-technologies.edit', [
            'experiencedTechnology' => $experiencedTechnology,
            'technologyFields' => TechnologyField::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, ExperiencedTechnology $experiencedTechnology): RedirectResponse
    {
        $experiencedTechnology->update($this->validated($request, $experiencedTechnology));

        return to_route('experienced-technologies.index')->with('status', '経験技術を更新しました。');
    }

    public function destroy(ExperiencedTechnology $experiencedTechnology): RedirectResponse
    {
        $experiencedTechnology->delete();

        return to_route('experienced-technologies.index')->with('status', '経験技術を削除しました。');
    }

    /** @return array<string, mixed> */
    private function validated(Request $request, ?ExperiencedTechnology $experiencedTechnology = null): array
    {
        return $request->validate([
            'technology_field_id' => ['required', 'integer', 'exists:technology_fields,id'],
            'name' => [
                'required',
                'string',
                'max:80',
                Rule::unique('experienced_technologies')->where(
                    fn ($query) => $query->where('technology_field_id', $request->integer('technology_field_id'))
                )->ignore($experiencedTechnology),
            ],
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\ExperiencedTechnology;
use App\Models\TechnologyField;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TechnologyManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_technology_management(): void
    {
        $this->get(route('technology-fields.index'))->assertRedirect(route('login'));
        $this->get(route('experienced-technologies.index'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_manage_technology_field(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('technology-fields.store'), ['name' => 'MOBILE'])
            ->assertRedirect(route('technology-fields.index'));

        $field = TechnologyField::where('name', 'MOBILE')->firstOrFail();
        $this->actingAs($user)->put(route('technology-fields.update', $field), ['name' => 'MOBILE APP'])
            ->assertRedirect(route('technology-fields.index'));
        $this->assertDatabaseHas('technology_fields', ['id' => $field->id, 'name' => 'MOBILE APP']);

        $this->actingAs($user)->delete(route('technology-fields.destroy', $field))
            ->assertRedirect(route('technology-fields.index'));
        $this->assertDatabaseMissing('technology_fields', ['id' => $field->id]);
    }

    public function test_multiple_technologies_can_be_registered_to_a_field(): void
    {
        $user = User::factory()->create();
        $field = TechnologyField::create(['name' => 'MOBILE']);

        foreach (['Flutter', 'React Native'] as $name) {
            $this->actingAs($user)->post(route('experienced-technologies.store'), [
                'technology_field_id' => $field->id,
                'name' => $name,
            ])->assertRedirect(route('experienced-technologies.index'));
        }

        $this->assertDatabaseHas('experienced_technologies', ['technology_field_id' => $field->id, 'name' => 'Flutter']);
        $this->assertDatabaseHas('experienced_technologies', ['technology_field_id' => $field->id, 'name' => 'React Native']);
        $this->assertCount(2, $field->experiencedTechnologies()->get());
    }

    public function test_authenticated_user_can_update_and_delete_experienced_technology(): void
    {
        $user = User::factory()->create();
        $field = TechnologyField::create(['name' => 'MOBILE']);
        $technology = ExperiencedTechnology::create(['technology_field_id' => $field->id, 'name' => 'Flutter']);

        $this->actingAs($user)->put(route('experienced-technologies.update', $technology), [
            'technology_field_id' => $field->id,
            'name' => 'Dart / Flutter',
        ])->assertRedirect(route('experienced-technologies.index'));
        $this->assertDatabaseHas('experienced_technologies', ['id' => $technology->id, 'name' => 'Dart / Flutter']);

        $this->actingAs($user)->delete(route('experienced-technologies.destroy', $technology))
            ->assertRedirect(route('experienced-technologies.index'));
        $this->assertDatabaseMissing('experienced_technologies', ['id' => $technology->id]);
    }

    public function test_deleting_field_cascades_to_its_technologies(): void
    {
        $field = TechnologyField::create(['name' => 'MOBILE']);
        $technology = ExperiencedTechnology::create(['technology_field_id' => $field->id, 'name' => 'Flutter']);

        $field->delete();

        $this->assertDatabaseMissing('experienced_technologies', ['id' => $technology->id]);
    }

    public function test_saved_fields_and_technologies_are_rendered_on_public_page(): void
    {
        $field = TechnologyField::create(['name' => 'MOBILE']);
        ExperiencedTechnology::create(['technology_field_id' => $field->id, 'name' => 'Flutter']);
        ExperiencedTechnology::create(['technology_field_id' => $field->id, 'name' => 'Dart']);

        $this->get('/')->assertOk()->assertSee('MOBILE')->assertSee('Flutter')->assertSee('Dart');
    }

    public function test_duplicate_technology_in_same_field_is_rejected(): void
    {
        $user = User::factory()->create();
        $field = TechnologyField::create(['name' => 'MOBILE']);
        ExperiencedTechnology::create(['technology_field_id' => $field->id, 'name' => 'Flutter']);

        $this->actingAs($user)->post(route('experienced-technologies.store'), [
            'technology_field_id' => $field->id,
            'name' => 'Flutter',
        ])->assertSessionHasErrors('name');
    }
}

<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_dynamic_catalog_sections(): void
    {
        $category = Category::create([
            'name' => 'Peptides',
            'description' => 'Peptide building blocks',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Test Compound',
            'category_id' => $category->id,
            'cas_number' => '50-00-0',
            'molecular_formula' => 'CH2O',
            'molecular_weight' => '30.03',
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Featured compounds from the catalog');
        $response->assertSee('Peptides');
        $response->assertSee('Test Compound');
    }
}

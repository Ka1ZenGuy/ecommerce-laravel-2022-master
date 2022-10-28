<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontpageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_the_application_returns_404_code_on_not_found(){
        $response = $this->get('/aguacate');
        $response->assertStatus(404);
    }

    public function test_the_new_category_route_works(){

        $response = $this->post((route('create-category',[
            "name" => "category-test",
        ])));
        $response->assertStatus(302);
    }

    public function test_empty_category_names_are_no_saved()
    {
        $category_number = Category::all()->count();
        $response = $this->post(route('create-category', []));
        $this->assertDatabaseCount('categories', $category_number);
        $response->assertStatus(302);
    }
    public function test_single_product_view_shows_data(){
        $product = Product::factory()->create();
        $related_products = Product::factory(3)->create();
        $view = $this->view('public.single-product', [

            "product" => $product,
            "related_products" => $related_products,
        ]);
        $view->assertSee($product->name);
        $view->assertSee($product->content);
    }

}

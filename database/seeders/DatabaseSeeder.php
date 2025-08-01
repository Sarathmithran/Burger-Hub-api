<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $burgers = Category::create(['name' => 'Burgers']);
        $drinks = Category::create(['name' => 'Drinks']);
        $sides = Category::create(['name' => 'Sides']);

        // 🍔 6 Burger Items
        Menu::create([
            'name' => 'Classic Burger',
            'description' => 'Beef patty with lettuce, tomato, and special sauce',
            'price' => 5.99,
            'rating' => 4.5,
            'image' => 'menus/classic-burger.jpg',
            'category_id' => $burgers->id,
        ]);

        Menu::create([
            'name' => 'Cheeseburger',
            'description' => 'Burger with melted American cheese',
            'price' => 6.49,
            'rating' => 4.3,
            'image' => 'menus/cheeseburger.jpg',
            'category_id' => $burgers->id,
        ]);

        Menu::create([
            'name' => 'Bacon Burger',
            'description' => 'Topped with crispy bacon and BBQ sauce',
            'price' => 7.29,
            'rating' => 4.6,
            'image' => 'menus/bacon-burger.jpg',
            'category_id' => $burgers->id,
        ]);

        Menu::create([
            'name' => 'Double Decker',
            'description' => 'Two patties, double cheese, big appetite',
            'price' => 8.99,
            'rating' => 4.8,
            'image' => 'menus/double-decker.jpg',
            'category_id' => $burgers->id,
        ]);

        Menu::create([
            'name' => 'Spicy Jalapeno Burger',
            'description' => 'With pepper jack cheese and jalapeños',
            'price' => 7.59,
            'rating' => 4.2,
            'image' => 'menus/spicy-burger.jpg',
            'category_id' => $burgers->id,
        ]);

        Menu::create([
            'name' => 'Veggie Burger',
            'description' => 'Grilled plant-based patty with fresh veggies',
            'price' => 6.99,
            'rating' => 4.0,
            'image' => 'menus/veggie-burger.jpg',
            'category_id' => $burgers->id,
        ]);

        // 🥤 4 Drink Items
        Menu::create([
            'name' => 'Cola',
            'description' => 'Classic cola soda - 16oz',
            'price' => 1.99,
            'rating' => 3.8,
            'image' => 'menus/cola.jpg',
            'category_id' => $drinks->id,
        ]);

        Menu::create([
            'name' => 'Lemonade',
            'description' => 'Fresh-squeezed lemon juice drink',
            'price' => 2.29,
            'rating' => 4.1,
            'image' => 'menus/lemonade.jpg',
            'category_id' => $drinks->id,
        ]);

        Menu::create([
            'name' => 'Iced Tea',
            'description' => 'Chilled black tea with lemon',
            'price' => 2.49,
            'rating' => 4.0,
            'image' => 'menus/iced-tea.jpg',
            'category_id' => $drinks->id,
        ]);

        Menu::create([
            'name' => 'Milkshake',
            'description' => 'Vanilla milkshake with whipped cream',
            'price' => 3.49,
            'rating' => 4.7,
            'image' => 'menus/milkshake.jpg',
            'category_id' => $drinks->id,
        ]);

        // 🍟 5 Side Items
        Menu::create([
            'name' => 'French Fries',
            'description' => 'Crispy golden fries with seasoning',
            'price' => 2.49,
            'rating' => 4.3,
            'image' => 'menus/fries.jpg',
            'category_id' => $sides->id,
        ]);

        Menu::create([
            'name' => 'Onion Rings',
            'description' => 'Battered and deep-fried onion slices',
            'price' => 2.99,
            'rating' => 4.0,
            'image' => 'menus/onion-rings.jpg',
            'category_id' => $sides->id,
        ]);

        Menu::create([
            'name' => 'Mozzarella Sticks',
            'description' => 'Fried cheese sticks served with marinara',
            'price' => 3.29,
            'rating' => 4.5,
            'image' => 'menus/mozzarella-sticks.jpg',
            'category_id' => $sides->id,
        ]);

        Menu::create([
            'name' => 'Side Salad',
            'description' => 'Fresh garden salad with dressing',
            'price' => 3.49,
            'rating' => 3.9,
            'image' => 'menus/salad.jpg',
            'category_id' => $sides->id,
        ]);

        Menu::create([
            'name' => 'Chicken Nuggets',
            'description' => '6-piece crispy chicken nuggets',
            'price' => 3.99,
            'rating' => 4.6,
            'image' => 'menus/nuggets.jpg',
            'category_id' => $sides->id,
        ]);

        // 👤 Test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Newborn (0-12 months)',
                'name_ar' => 'حديثو الولادة (0-12 شهر)',
                'sub' => [
                    ['name_en' => 'Bodysuits', 'name_ar' => 'ملابس داخلية'],
                    ['name_en' => 'Rompers', 'name_ar' => 'أفرولات'],
                    ['name_en' => 'Swaddle Blankets', 'name_ar' => 'بطاطين التقميط'],
                    ['name_en' => 'Caps & Mittens', 'name_ar' => 'قبعات وقفازات'],
                    ['name_en' => 'Sleepwear', 'name_ar' => 'ملابس النوم'],
                ],
            ],
            [
                'name_en' => 'Baby Boys (1-3 years)',
                'name_ar' => 'أولاد رضع (1-3 سنوات)',
                'sub' => [
                    ['name_en' => 'Shirts', 'name_ar' => 'قمصان'],
                    ['name_en' => 'Pants', 'name_ar' => 'بناطيل'],
                    ['name_en' => 'Jackets', 'name_ar' => 'جاكيتات'],
                    ['name_en' => 'T-Shirts', 'name_ar' => 'تيشيرتات'],
                    ['name_en' => 'Shoes', 'name_ar' => 'أحذية'],
                ],
            ],
            [
                'name_en' => 'Baby Girls (1-3 years)',
                'name_ar' => 'بنات رضع (1-3 سنوات)',
                'sub' => [
                    ['name_en' => 'Dresses', 'name_ar' => 'فساتين'],
                    ['name_en' => 'Leggings', 'name_ar' => 'ليجنز'],
                    ['name_en' => 'Tops', 'name_ar' => 'بلوزات'],
                    ['name_en' => 'Shoes', 'name_ar' => 'أحذية'],
                    ['name_en' => 'Accessories', 'name_ar' => 'إكسسوارات'],
                ],
            ],
            [
                'name_en' => 'Boys (4-8 years)',
                'name_ar' => 'أولاد (4-8 سنوات)',
                'sub' => [
                    ['name_en' => 'T-Shirts', 'name_ar' => 'تيشيرتات'],
                    ['name_en' => 'Shorts', 'name_ar' => 'شورتات'],
                    ['name_en' => 'Jeans', 'name_ar' => 'جينز'],
                    ['name_en' => 'Sweatshirts', 'name_ar' => 'سويت شيرتات'],
                    ['name_en' => 'Sneakers', 'name_ar' => 'أحذية رياضية'],
                ],
            ],
            [
                'name_en' => 'Girls (4-8 years)',
                'name_ar' => 'بنات (4-8 سنوات)',
                'sub' => [
                    ['name_en' => 'Skirts', 'name_ar' => 'جيبات'],
                    ['name_en' => 'Dresses', 'name_ar' => 'فساتين'],
                    ['name_en' => 'Blouses', 'name_ar' => 'بلوزات'],
                    ['name_en' => 'Pants', 'name_ar' => 'بناطيل'],
                    ['name_en' => 'Ballet Flats', 'name_ar' => 'أحذية فلات'],
                ],
            ],
            [
                'name_en' => 'Girls (9-14 years)',
                'name_ar' => 'بنات (9-14 سنة)',
                'sub' => [
                    ['name_en' => 'Casual Dresses', 'name_ar' => 'فساتين كاجوال'],
                    ['name_en' => 'Cardigans', 'name_ar' => 'كارديجانات'],
                    ['name_en' => 'Denim Jeans', 'name_ar' => 'جينز'],
                    ['name_en' => 'Sportwear', 'name_ar' => 'ملابس رياضية'],
                    ['name_en' => 'Backpacks', 'name_ar' => 'حقائب ظهر'],
                ],
            ],
            [
                'name_en' => 'T-Shirts',
                'name_ar' => 'تيشيرتات',
                'sub' => [
                    ['name_en' => 'Printed', 'name_ar' => 'مطبوعة'],
                    ['name_en' => 'Plain', 'name_ar' => 'سادة'],
                    ['name_en' => 'With Characters', 'name_ar' => 'بشخصيات كرتونية'],
                    ['name_en' => 'Long Sleeve', 'name_ar' => 'كم طويل'],
                    ['name_en' => 'Short Sleeve', 'name_ar' => 'كم قصير'],
                ],
            ],
            [
                'name_en' => 'Shoes & Sandals',
                'name_ar' => 'أحذية وصنادل',
                'sub' => [
                    ['name_en' => 'Sneakers', 'name_ar' => 'أحذية رياضية'],
                    ['name_en' => 'Sandals', 'name_ar' => 'صنادل'],
                    ['name_en' => 'Boots', 'name_ar' => 'أحذية شتوية'],
                    ['name_en' => 'Formal Shoes', 'name_ar' => 'أحذية رسمية'],
                    ['name_en' => 'School Shoes', 'name_ar' => 'أحذية مدرسية'],
                ],
            ],
            [
                'name_en' => 'Accessories',
                'name_ar' => 'اكسسوارات',
                'sub' => [
                    ['name_en' => 'Hats & Caps', 'name_ar' => 'قبعات'],
                    ['name_en' => 'Scarves', 'name_ar' => 'أوشحة'],
                    ['name_en' => 'Sunglasses', 'name_ar' => 'نظارات شمس'],
                    ['name_en' => 'Belts', 'name_ar' => 'أحزمة'],
                    ['name_en' => 'Hair Accessories', 'name_ar' => 'إكسسوارات شعر'],
                ],
            ],
            [
                'name_en' => 'School Uniforms',
                'name_ar' => 'الزي المدرسي',
                'sub' => [
                    ['name_en' => 'Shirts', 'name_ar' => 'قمصان'],
                    ['name_en' => 'Pants', 'name_ar' => 'بناطيل'],
                    ['name_en' => 'Skirts', 'name_ar' => 'جيبات'],
                    ['name_en' => 'Blazers', 'name_ar' => 'بليزرات'],
                    ['name_en' => 'Shoes', 'name_ar' => 'أحذية'],
                ],
            ],
        ];




        $translates = [];

        foreach ($categories as $category) {
            $category_db = Category::create(['is_featured' => rand(0, 1)]);
            $translates[] = [
                "lang" => "ar",
                "name" => $category['name_ar'],
                "category_id" => $category_db->id,
            ];

            $translates[] = [
                "lang" => "en",
                "name" => $category['name_en'],
                "category_id" => $category_db->id,
            ];


            if (isset($category['sub'])) {
                foreach ($category['sub'] as $subcategory) {
                    $subcategory_db = Category::create([
                        "parent_id" => $category_db->id
                    ]);
                    $translates[] = [
                        "lang" => "ar",
                        "name" => $subcategory['name_ar'],
                        "category_id" => $subcategory_db->id,
                    ];

                    $translates[] = [
                        "lang" => "en",
                        "name" => $subcategory['name_en'],
                        "category_id" => $subcategory_db->id,
                    ];
                }
            }
        }


        CategoryTranslate::insert($translates);
    }
}

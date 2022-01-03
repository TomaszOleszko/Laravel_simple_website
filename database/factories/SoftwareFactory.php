<?php

namespace Database\Factories;

use App\Models\Software;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoftwareFactory extends Factory
{
    protected $model = Software::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   $icons = ['fas fa-file-archive', 'far fa-file-archive', 'fas fa-file', 'far fa-file'];
        $lic = ['apache2','GNU3','MIT','CCZ'];
        return [
            'title' => $this->faker->domainWord,
            'user_id' => 1,
            'description' => $this->faker->text(200),
            'link' => $this->faker->url,
            'icon' => $icons[array_rand($icons,1)],
            'licence' => $lic[array_rand($lic,1)]
        ];
    }
}

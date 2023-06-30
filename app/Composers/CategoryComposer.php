<?php

namespace App\Composers;

use App\Models\Catagory;

class CategoryComposer
{
    public $categories;

    public function compose($view)
    {
        if (empty($this->categories)){
            $this->categories = Catagory::all();
        }

        return $view->with('categories', $this->categories);
    }
}

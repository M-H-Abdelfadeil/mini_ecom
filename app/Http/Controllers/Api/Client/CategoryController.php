<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Services\ResponseService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::active()->justParent()->paginate(config("app.pagination.items_per_page"));
        $categories = CategoryResource::collection($categories)->response()->getData();
        return ResponseService::send_response_success($categories);
    }

    public function sub($id)
    {
        $category = Category::with("sub",  function ($q) {

            $q->active();
        })->active()->justParent()->find($id);
        if (!$category) {

            return ResponseService::send_not_found();
        }
        return ResponseService::send_response_success(CategoryResource::collection($category->sub));
    }


    public function sub_with_paginate($id)
    {
        $category = Category::active()->justParent()->find($id);
        if (!$category) {
            return ResponseService::send_not_found();
        }
        $categories = Category::active()->where("parent_id", $id)->paginate(config("app.pagination.items_per_page"));
        $categories = CategoryResource::collection($categories)->response()->getData();
        return ResponseService::send_response_success($categories);
    }
}

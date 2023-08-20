<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Resources\TagCollection;
use App\Api\Http\Resources\TagResource;
use App\Api\Queries\TagIndexQuery;
use Domain\Tags\Models\Tag;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('precognitive')->only(['store', 'update']);

        $this->authorizeResource(Tag::class, 'tag');
    }

    public function index(TagIndexQuery $query): TagCollection
    {
        return new TagCollection(
            $query->jsonPaginate()
        );
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Tag $model): TagResource
    {
        return new TagResource(
            $model
        );
    }

    public function update(Request $request, Tag $model)
    {
        //
    }

    public function destroy(Tag $model)
    {
        //
    }
}

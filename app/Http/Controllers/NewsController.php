<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\NewsCreatedEvent;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsResourceCollection;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return NewsResourceCollection
     */
    public function index()
    {
        return new NewsResourceCollection(News::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @return NewsResource
     */
    public function store(NewsRequest $request)
    {
        $data = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => $request->user()->id,
        ];
        $tempNews = News::create($data);
        event(new NewsCreatedEvent($request->get('title')));
        return new NewsResource($tempNews);
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return NewsResource
     */
    public function show(News $news)
    {
        return new NewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param News $news
     * @return NewsResource
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->update($request->all());
        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return JsonResponse
     */
    public function destroy(News $news)
    {
        $response = new JsonResponse();
        $data = [
            'status' => true,
        ];
        try {
            $news->delete();
        } catch (\Exception $exception) {
            $data['status'] = false;
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        $response->setData(['data' => $data,]);
        return $response;
    }
}

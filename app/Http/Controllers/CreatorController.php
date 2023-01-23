<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreatorRequest;
use App\Http\Requests\UpdateCreatorRequest;
use App\Http\Resources\CreatorResource;
use App\Http\Resources\WelcomeResource;
use App\Models\Book;
use App\Models\Creator;
use App\Models\Film;
use App\Models\Song;
use Illuminate\Support\Arr;

class CreatorController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreatorRequest $request)
    {
        $data = $request->validated();
        $creator = Creator::create($data['data']);

        foreach($data['data']['books'] as $book) {
            $book['creator_id'] = $creator->id;
            Book::create($book);
        }

        foreach($data['data']['films'] as $film) {
            $film['creator_id'] = $creator->id;
            Film::create($film);
        }

        foreach($data['data']['songs'] as $song) {
            $song['creator_id'] = $creator->id;
            Song::create($song);
        }

        $creator->with(['books', 'films', 'songs'])->first();

        return new CreatorResource($creator);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function show(Creator $creator)
    {
        $creator = $creator->with(['books', 'films', 'songs'])->first();
        return new CreatorResource($creator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreatorRequest $request, Creator $creator)
    {
        $data = $request->validated();
        $creator->update($data['data']);
        
        $this->updateBooklist($data, $creator);
        $this->updateFilmlist($data, $creator);
        $this->updateSonglist($data, $creator);

        $creator->with(['books', 'films', 'songs'])->first();

        return new CreatorResource($creator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creator $creator)
    {
        $response = $creator->delete();

        $creators = Creator::with(['books', 'films', 'songs'])->get();

        // return response('', 204);
        return WelcomeResource::collection($creators);
    }


    /**
     * Private functions
     */

    private function updateBooklist($data, $creator)
    {
        $existingIds = $creator->books()->pluck('id')->toArray();
        $newIds = Arr::pluck($data['data']['books'], 'id');
        
        $toDelete = array_diff($existingIds, $newIds);
        $toAdd = array_diff($newIds, $existingIds);
        
        Book::destroy($toDelete);
        
        foreach ($data['data']['books'] as $book) {
            if (in_array($book['id'], $toAdd)) {
                $book['creator_id'] = $creator->id;
                Book::create($book);
            } elseif (in_array($book['id'], $existingIds)) {
                $item = Book::find($book['id']);
                $item->update($book);
            }
        }
    }

    private function updateFilmlist($data, $creator)
    {
        $existingIds = $creator->films()->pluck('id')->toArray();
        $newIds = Arr::pluck($data['data']['films'], 'id');
        
        $toDelete = array_diff($existingIds, $newIds);
        $toAdd = array_diff($newIds, $existingIds);
        
        Film::destroy($toDelete);
        
        foreach ($data['data']['films'] as $film) {
            if (in_array($film['id'], $toAdd)) {
                $film['creator_id'] = $creator->id;
                Film::create($film);
            } elseif (in_array($film['id'], $existingIds)) {
                $item = Film::find($film['id']);
                $item->update($film);
            }
        }
    }

    private function updateSonglist($data, $creator)
    {
        $existingIds = $creator->songs()->pluck('id')->toArray();
        $newIds = Arr::pluck($data['data']['songs'], 'id');
        
        $toDelete = array_diff($existingIds, $newIds);
        $toAdd = array_diff($newIds, $existingIds);
        
        Song::destroy($toDelete);
        
        foreach ($data['data']['songs'] as $song) {
            if (in_array($song['id'], $toAdd)) {
                $song['creator_id'] = $creator->id;
                Song::create($song);
            } elseif (in_array($song['id'], $existingIds)) {
                $item = Song::find($song['id']);
                $item->update($song);
            }
        }
    }
}

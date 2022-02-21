<?php

namespace App\Repositories;

use App\Http\Requests\SlideRequest;
use App\Models\Slide;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SlideRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     *
     */
    public function boot()
    {
        //
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Slide::class;
    }

    /**
     * Find data by multiple fields
     *
     * @param array $params
     * @return mixed
     */
    public function search($params)
    {
        $conditions = $this->getSearchConditions($params);
        $conditionsFormated = [];

        if (isset($conditions['name'])) {
            $conditionsFormated[] = ['name', 'like', '%' . $params['name'] . '%'];
        }

        $columns = [
            'id',
            'name',
            'image',
            'position'
        ];

        $params['conditions'] = $conditionsFormated;
        $params['limit'] = 15;
        $result = $this->searchByParams($params, $columns);

        return $result;
    }

    /**
     *  Store post save file img to folder storage/post/img
     *
     * @param array $params
     * @return mixed
     */

    public function store($params)
    {
        $file = $params['image'];
        $nameFile = Carbon::now()->timestamp . $file->getClientOriginalName();

        Storage::putFileAs('public/slide/image', $file, $nameFile);
        $url = 'http://localhost:8000/storage/slide/image/' . $nameFile;
        $params['image'] = $url;
        return $this->create($params);
    }

    /**
     *  Store post save file img to folder storage/post/img
     *
     * @param array $params
     * @return mixed
     */
    public function updateSlide($params, $id)
    {
        $slide = Slide::find($id);
        if ($params['image'] != $slide->image) {
            $file = $params['image'];
            $nameFile = Carbon::now()->timestamp . $file->getClientOriginalName();

            Storage::putFileAs('public/slide/image', $file, $nameFile);
            $url = config('app.url') . '/storage/slide/image/' . $nameFile;
            $params['image'] = $url;

            Storage::delete($slide->image);
        }
        return $this->update($params, $id);
    }
}

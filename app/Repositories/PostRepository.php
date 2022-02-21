<?php


namespace App\Repositories;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostRepository extends BaseRepository
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
        return Post::class;
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

        if (isset($conditions['title'])) {
            $conditionsFormated[] = ['title', 'like', '%' . $params['title'] . '%'];
        }

        if (isset($conditions['public_start_at'])) {
            $conditionsFormated[] = ['public_start_at', '>=', $params['public_start_at']];
        }

        if (isset($conditions['public_end_at'])) {
            $conditionsFormated[] = ['public_end_at', '>=', $params['public_end_at']];
        }

        if (isset($conditions['status'])) {
            $conditionsFormated[] = ['status', '=', $conditions['status']];
        }

        if (isset($conditions['category_id'])) {
            $conditionsFormated[] = ['category_id', '=', $conditions['category_id']];
        }

        if (isset($conditions['content'])) {
            $conditionsFormated[] = ['content', 'like', '%' . $params['content'] . '%'];
        }

        if (isset($conditions['sortBy'])) {
            $this->orderBy($params['sortBy'], $params['sortType'] == 1 ? 'desc' : 'asc');
        }

        $columns = [
            'id',
            'category_id',
            'title',
            'status',
            'img',
            'public_start_at',
            'public_end_at',
            'viewed',
            'description'
        ];
        if (isset($params['isContent']))
        {
            array_push($columns, 'content');
        }
        $params['conditions'] = $conditionsFormated;
        $params['limit'] = 15;
        $result = $this->searchByParams($params, $columns);

        return $result;
    }

    /**
     * Get 15 post by viewed DESC
     *
     * @param array $params
     * @return mixed
     */
    public function getListPopular($params)
    {
        $conditions = $this->getSearchConditions($params);
        $conditionsFormated = [];

        if (isset($conditions['category_id'])) {
            $conditionsFormated[] = ['category_id', '=', $conditions['category_id']];
        }

        $params['conditions'] = $conditionsFormated;
        $params['sortBy'] = 'viewed';
        $params['sortType'] =  'desc';
        $params['limit'] = 15;

        $this->orderBy($params['sortBy'], $params['sortType']);
        $result = $this->searchByParams($params);
        return $result;
    }


    /**
     * Get post new
     *
     * @param array $params
     * @return mixed
     */
    public function getListNew($params)
    {
        $conditions = $this->getSearchConditions($params);
        $conditionsFormated = [];

        if (isset($conditions['category_id'])) {
            $conditionsFormated[] = ['category_id', '=', $conditions['category_id']];
        }

        $params['sortBy'] = 'created_at';
        $params['sortType'] =  'desc';
        $params['limit'] = 1;

        $this->orderBy($params['sortBy'], $params['sortType']);
        $result = $this->searchByParams($params);
        return $result;
    }

     /**
     * Get post radom
     *
     * @return mixed
     */
    public function getListRadom()
    {
       return Post::inRandomOrder()->where('status', Post::STATUS_POST_ENABLED)->limit(5)->get();
    }

    /**
     *  Store post save file img to folder storage/post/img
     *
     * @param array $params
     * @return mixed
     */

    public function store($params)
    {
        $file = $params['img'];
        $nameFile = Carbon::now()->timestamp . $file->getClientOriginalName();

        Storage::putFileAs('public/post/img', $file, $nameFile);
        $url = 'http://localhost:8000/storage/post/img/' . $nameFile;
        $params['img'] = $url;
        return $this->create($params);
    }

    /**
     *  Store post save file img to folder storage/post/img
     *
     * @param array $params
     * @return mixed
     */
    public function updatePost($params, $id)
    {
        $post = Post::find($id);
        if ($params['img'] != $post->img) {
            $file = $params['img'];
            $nameFile = Carbon::now()->timestamp . $file->getClientOriginalName();

            Storage::putFileAs('public/post/img', $file, $nameFile);
            $url = config('app.url') . '/storage/post/img/' . $nameFile;
            $params['img'] = $url;

            Storage::delete($post->img);
        }
        return $this->update($params, $id);
    }
}

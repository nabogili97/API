<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository extends BaseRepository
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
        return User::class;
    }

        
    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function search($params)
    {
        $conditions = $this->getSearchConditions($params);
        $conditionsFormated = [];

        if (isset($conditions['name'])) {
            $conditionsFormated[] = ['name', 'like', '%'.$params['name'].'%'];
        }

        if (isset($conditions['email'])) {
            $conditionsFormated[] = ['email' , 'like', '%'.$params['email'].'%'];
        }

        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }

    /**
     * Update Password 
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return parent::update($attributes, $id);
    }

}
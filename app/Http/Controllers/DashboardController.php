<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\KeywordRepository;
use App\Repositories\UserRepository;
use App\Repositories\SettingRepository;
use App\Http\Resources\KeywordResource;



class DashboardController extends Controller
{
    /**
     * @var Repository
     */
    protected $keywordRepository;
    protected $userRepository;
    protected $settingRepository;

    /**
     * Construct
    */
    public function __construct()
    {
        $this->keywordRepository = new KeywordRepository();
        $this->userRepository = new UserRepository();
        $this->settingRepository = new SettingRepository();
    }

    /**
    * Total Search 
    * Total Setting
    * Total Keyword
    * Total User
    */
    public function count() {
        $totalSearch = $this->keywordRepository->total('total');
        $totalSetting = $this->settingRepository->count([], 'id');
        $totalUser = $this->userRepository->count([], 'id');
        $totalKeyword = $this->keywordRepository->count([], 'id');
        return [
            "totalSetting" => $totalSetting,
            "totalUser" => $totalUser,
            "totalKeyword" => $totalKeyword,
            "totalSearch" => $totalSearch
        ];
    }
}

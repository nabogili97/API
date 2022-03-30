<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Helpers\Date;


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
    // public function __construct()
    // {
    //     $this->keywordRepository = new KeywordRepository();
    //     $this->userRepository = new UserRepository();
    //     $this->settingRepository = new SettingRepository();
    // }

    /**
    * Total Search 
    * Total Setting
    * Total Keyword
    * Total User
    */
    // public function count() {
    //     $totalSearch = $this->keywordRepository->total('total');
    //     $totalSetting = $this->settingRepository->count([], 'id');
    //     $totalUser = $this->userRepository->count([], 'id');
    //     $totalKeyword = $this->keywordRepository->count([], 'id');
    //     return [
    //         "totalSetting" => $totalSetting,
    //         "totalUser" => $totalUser,
    //         "totalKeyword" => $totalKeyword,
    //         "totalSearch" => $totalSearch
    //     ];
    // }


    public function statistical()
    {

        //Doanh thu theo tháng khi trạng thái bằng 3
        $revenue = Payment::where('status', 3)
            ->whereMonth('created_at',date('m'))
            ->select(DB::raw('sum(amount) as totalMoney'), DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();

        $listDay = Date::getListDayinMonth();
        $arrayRevenue = [];

        foreach ($listDay as $day) {
            $total = 0;
            foreach($revenue as $key => $reve) {
                if($reve['day']  == $day) {
                    $total = $reve['totalMoney'];
                    break;
                }
            }

            $arrayRevenue[] = $total;

        }

        // $statusTransaction = [
        //     $confirm,$transported,$success,$return
        // ];

        return $arrayRevenue;

        // return response()->json($statusTransaction);
    }

    public function orderStatus()
    {
        //Chưa xác nhận
        $confirmation = Payment::where('status', 0)->select('id')->count();

        // Đơn hàng đã xác nhận
        $confirm = Payment::where('status', 1)->select('id')->count();

        // Đơn hàng đang vận chuyển
        $transported = Payment::where('status', 2)->select('id')->count();

        // Đơn hàng đã nhận
        $success = Payment::where('status', 3)->select('id')->count();

        // Đơn hàng bị hoàn
        $return = Payment::where('status', 4)->select('id')->count();

        $arrayStaus = [$confirmation, $confirm, $transported, $success, $return ];

        return $arrayStaus;

    }

    public function dayList()
    {
        $listDay = Date::getListDayinMonth();

        return $listDay;
    }
}

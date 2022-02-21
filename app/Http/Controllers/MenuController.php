<?php



namespace App\Http\Controllers;

use App\Repositories\MenuRepository;
use App\Http\Resources\MenuResource;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * @var Repository
     */
    protected $menuRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->menuRepository = new MenuRepository();
    }

    /**
     * Find data by multiple fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        $categories = $this->menuRepository->search($params);
        $jsonCategories = MenuResource::collection($categories);

        return $jsonCategories;
    }

    /**
     * Get list menu with status = 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listMenu(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();
        $params['conditions']['status'] = Menu::MENU_ENABLED;

        $categories = $this->menuRepository->search($params);
        $jsonCategories = MenuResource::collection($categories);

        return $jsonCategories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Menu\MenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu = $this->menuRepository->create($request->all());
        $jsonMenu = new MenuResource($menu);

        return $jsonMenu;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $menu = $this->menuRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonMenu = new MenuResource($menu);

        return $jsonMenu;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Menu\MenuRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        try {
            $menu = $this->menuRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonMenu = new MenuResource($menu);

        return $jsonMenu;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Menu\MenuRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePosition(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            try {
                $menu = $this->menuRepository->update($value, $value['id']);
            } catch (\Throwable $th) {
                return response()->json([
                    'data' => ['errors' => ['exception' => $th->getMessage()]]
                ], 400);
            }
            $jsonMenu[$key] = new MenuResource($menu);
        }
    return $jsonMenu;
    }

    /**
     * Update Status.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $menu = $this->menuRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonMenu = new MenuResource($menu);

        return $jsonMenu;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->menuRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}

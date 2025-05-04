/**
 * ListsController
 *
 * @author HarryFan
 * @see Airbnb JavaScript Style Guide
 */
namespace App\Http\Controllers;

use App\Models\ListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListsController extends Controller
{
  /**
   * 取得指定看板的所有清單
   */
  public function index(Request $request)
  {
    $boardId = $request->query('board_id');
    $lists = ListModel::where('board_id', $boardId)->with('cards')->orderBy('position')->get();
    return response()->json($lists);
  }

  /**
   * 建立新清單
   */
  public function store(Request $request)
  {
    $request->validate([
      'board_id' => 'required|integer|exists:boards,id',
      'title' => 'required|string|max:255',
      'position' => 'integer',
    ]);
    $list = ListModel::create($request->only(['board_id', 'title', 'position']));
    return response()->json($list, 201);
  }

  /**
   * 顯示單一清單
   */
  public function show(ListModel $list)
  {
    $list->load('cards');
    return response()->json($list);
  }

  /**
   * 更新清單
   */
  public function update(Request $request, ListModel $list)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'position' => 'integer',
    ]);
    $list->update($request->only(['title', 'position']));
    return response()->json($list);
  }

  /**
   * 刪除清單
   */
  public function destroy(ListModel $list)
  {
    $list->delete();
    return response()->json(null, 204);
  }
}

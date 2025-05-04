/**
 * BoardsController
 *
 * @author HarryFan
 * @see Airbnb JavaScript Style Guide
 */
namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardsController extends Controller
{
  /**
   * 取得目前用戶的所有看板
   */
  public function index()
  {
    $boards = Board::where('user_id', Auth::id())->with('lists')->get();
    return response()->json($boards);
  }

  /**
   * 建立新看板
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
    ]);
    $board = Board::create([
      'title' => $request->title,
      'user_id' => Auth::id(),
    ]);
    return response()->json($board, 201);
  }

  /**
   * 顯示單一看板
   */
  public function show(Board $board)
  {
    $this->authorize('view', $board);
    $board->load('lists');
    return response()->json($board);
  }

  /**
   * 更新看板
   */
  public function update(Request $request, Board $board)
  {
    $this->authorize('update', $board);
    $request->validate([
      'title' => 'required|string|max:255',
    ]);
    $board->update(['title' => $request->title]);
    return response()->json($board);
  }

  /**
   * 刪除看板
   */
  public function destroy(Board $board)
  {
    $this->authorize('delete', $board);
    $board->delete();
    return response()->json(null, 204);
  }
}

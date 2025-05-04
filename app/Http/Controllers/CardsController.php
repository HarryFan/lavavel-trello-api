/**
 * CardsController
 *
 * @author HarryFan
 * @see Airbnb JavaScript Style Guide
 */
namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardsController extends Controller
{
  /**
   * 取得指定清單的所有卡片
   */
  public function index(Request $request)
  {
    $listId = $request->query('list_id');
    $cards = Card::where('list_id', $listId)->orderBy('position')->get();
    return response()->json($cards);
  }

  /**
   * 建立新卡片
   */
  public function store(Request $request)
  {
    $request->validate([
      'list_id' => 'required|integer|exists:lists,id',
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'deadline' => 'nullable|date',
      'position' => 'integer',
    ]);
    $card = Card::create($request->only(['list_id', 'title', 'description', 'deadline', 'position']));
    return response()->json($card, 201);
  }

  /**
   * 顯示單一卡片
   */
  public function show(Card $card)
  {
    return response()->json($card);
  }

  /**
   * 更新卡片
   */
  public function update(Request $request, Card $card)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'deadline' => 'nullable|date',
      'position' => 'integer',
    ]);
    $card->update($request->only(['title', 'description', 'deadline', 'position']));
    return response()->json($card);
  }

  /**
   * 刪除卡片
   */
  public function destroy(Card $card)
  {
    $card->delete();
    return response()->json(null, 204);
  }
}

/**
 * NotificationSettingsController
 *
 * @author HarryFan
 * @see Airbnb JavaScript Style Guide
 */
namespace App\Http\Controllers;

use App\Models\NotificationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationSettingsController extends Controller
{
  /**
   * 取得目前用戶的通知設定
   */
  public function index()
  {
    $settings = NotificationSetting::where('user_id', Auth::id())->get();
    return response()->json($settings);
  }

  /**
   * 建立通知設定
   */
  public function store(Request $request)
  {
    $request->validate([
      'browser_enabled' => 'boolean',
      'email_enabled' => 'boolean',
      'email_lead_time' => 'integer',
      'browser_lead_time' => 'integer',
    ]);
    $setting = NotificationSetting::create(array_merge(
      $request->only(['browser_enabled', 'email_enabled', 'email_lead_time', 'browser_lead_time']),
      ['user_id' => Auth::id()]
    ));
    return response()->json($setting, 201);
  }

  /**
   * 顯示單一通知設定
   */
  public function show(NotificationSetting $notification_setting)
  {
    return response()->json($notification_setting);
  }

  /**
   * 更新通知設定
   */
  public function update(Request $request, NotificationSetting $notification_setting)
  {
    $request->validate([
      'browser_enabled' => 'boolean',
      'email_enabled' => 'boolean',
      'email_lead_time' => 'integer',
      'browser_lead_time' => 'integer',
    ]);
    $notification_setting->update($request->only(['browser_enabled', 'email_enabled', 'email_lead_time', 'browser_lead_time']));
    return response()->json($notification_setting);
  }

  /**
   * 刪除通知設定
   */
  public function destroy(NotificationSetting $notification_setting)
  {
    $notification_setting->delete();
    return response()->json(null, 204);
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    private $settingRecordID = 1;
    public function basicSetting()
    {
        $basicSetting = Setting::find($this->settingRecordID);
        return view('admin.setting.basic-setting', compact('basicSetting'));
    }

    public function updateBasicSetting(Request $request)
    {
      $setting = Setting::find($this->settingRecordID);
      $setting->name = $request->name;
      $setting->footer_text = $request->footer_text;
      $setting->default_language = $request->default_language;
      $setting->default_currency = $request->default_currency;
      $setting->save();
      return redirect()->back();
    }

}

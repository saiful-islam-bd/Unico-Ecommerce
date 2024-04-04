<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsTicker;

class NewsTickerController extends Controller
{
    public function AllNewsTicker()
    {
        $newsTicker = NewsTicker::latest()->get();
        return view('backend.newsTicker.newsTicker_all', compact('newsTicker'));
    } // End Method

    public function AddNewsTicker()
    {
        return view('backend.newsTicker.newsTicker_add');
    } // End Method

    public function StoreNewsTicker(Request $request)
    {
        NewsTicker::insert([
            'news' => $request->news,
        ]);

        $notification = [
            'message' => 'News Ticker Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->route('all.newsTicker')
            ->with($notification);
    } // End Method

    public function EditNewsTicker($id)
    {
        $newsTicker = NewsTicker::findOrFail($id);
        return view('backend.newsTicker.newsTicker_edit', compact('newsTicker'));
    } // End Method

    public function UpdateNewsTicker(Request $request)
    {
        $newsTicker_id = $request->id;

        NewsTicker::findOrFail($newsTicker_id)->update([
            'news' => $request->news,
        ]);

        $notification = [
            'message' => 'News Ticker Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->route('all.newsTicker')
            ->with($notification);
    } // End Method

    public function DeleteNewsTicker($id)
    {
        NewsTicker::findOrFail($id)->delete();

        $notification = [
            'message' => 'News Ticker Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->back()
            ->with($notification);
    } // End Method
}

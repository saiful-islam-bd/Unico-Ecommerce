<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsTicker;
use App\Models\NewsTickerDetails;

class NewsTickerDetailsController extends Controller
{
    public function AllNewsTickerDetails()
    {
        $newsTickerDetails = NewsTickerDetails::latest()->get();
        return view('backend.newsTickerDetails.newsTickerDetails_all', compact('newsTickerDetails'));
    } // End Method

    public function AddNewsTickerDetails()
    {
        $newsTicker = NewsTicker::orderBy('id', 'ASC')->get();
        return view('backend.newsTickerDetails.newsTickerDetails_add', compact('newsTicker'));
    } // End Method

    public function StoreNewsTickerDetails(Request $request)
    {
        NewsTickerDetails::insert([
            'ticker_id' => $request->ticker_id,
            'ticker_details' => $request->ticker_details,
            'ticker_slug' => strtolower(str_replace(' ', '_', $request->ticker_details)),
        ]);

        $notification = [
            'message' => 'Ticker Details Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->route('all.newsTickerDetails')
            ->with($notification);
    } // End Method

    public function EditNewsTickerDetails ($id)
    {
        $newsTicker = NewsTicker::orderBy('id', 'ASC')->get();
        $details = NewsTickerDetails::findOrFail($id);
        return view('backend.newsTickerDetails.newsTickerDetails_edit', compact('newsTicker', 'details'));
    } // End Method

    public function UpdateNewsTickerDetails(Request $request)
    {
        $details = $request->id;

        NewsTickerDetails::findOrFail($details)->update([
            'ticker_id' => $request->ticker_id,
            'ticker_details' => $request->ticker_details,
            'ticker_slug' => strtolower(str_replace(' ', '_', $request->ticker_details)),
        ]);

        $notification = [
            'message' => 'Details Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->route('all.newsTickerDetails')
            ->with($notification);
    } // End Method

    public function DeleteNewsTickerDetails($id)
    {
        NewsTickerDetails::findOrFail($id)->delete();

        $notification = [
            'message' => 'Details Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->back()
            ->with($notification);
    } // End Method


}

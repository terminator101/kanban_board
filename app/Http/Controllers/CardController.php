<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    //Create a new card
    public function store(Request $request)
    {
        //Get the number of cards in the column
        $card_info = DB::select('select count(*) as number_of_cards, MAX(order_number) as order_number from cards where column_id = ?', [$request->columnId]);
        $card_info = array_shift($card_info);
        
        DB::table('cards')->insert([
            'title' => 'Card ' . intval($card_info->number_of_cards + 1),
            'column_id' => $request->columnId,
            'order_number' => intval(($card_info->order_number ?: 0) + 1)
        ]);
        return redirect()->route('columns.index')
            ->with('success','Card created successfully.');
    }

    //Delete a card
    public function destroy(Card $card)
    {
        DB::table('cards')->where('id', '=', $card->id)->delete();
    	$card->delete();
    	return redirect()->route('columns.index')
            ->with('success','Card deleted successfully.');
    }
}

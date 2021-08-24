<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Column;
use Illuminate\Support\Facades\DB;

class ColumnController extends Controller
{
    //Display all columns
    public function index(Request $request)
    {
        $columns = Column::all();
        return view('kanbanboard', compact('columns'));
    }

    //Store a new column
    public function store(Request $request)
    {
        //Get the number of columns
        $column_no = DB::select('select count(*) as number from columns');
        $column_no = array_shift($column_no);
        
        //Create a new column and give it a number higher than the number of columns
        DB::table('columns')->insert([
            'title' => 'Column ' . intval($column_no->number + 1),
        ]);
        return redirect()->route('columns.index')
            ->with('success','Column created successfully.');
    }

    //Delete a column
    public function destroy(Column $column)
    {
    	$column->delete();
    	return redirect()->route('columns.index')
            ->with('success','Column deleted successfully.');
    }
}

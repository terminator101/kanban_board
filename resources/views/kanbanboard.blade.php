@extends('layout')

@section('content')

    <div id="app"> <!-- ID: 'app' -->
        <div class="row">
            <div class="col mx-auto">
                <h2>Kanban Board</h2>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <?php echo $message ?>
            </div>
        @endif
        <div class="row">
            <div class="col mx-auto">
                <div class="row">
                    @foreach ($columns as $column)
                        <div class="col-3 column">
                            <div class="row">
                                <div class="col">
                                    {{ $column->title }}
                                    <form action="{{ route('cards.store', 'columnId=' . $column->id ) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">+card</button>
                                    </form>
                                    <form action="{{ route('columns.destroy', $column->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                            @foreach ($cards as $card)
                                @if ($card->column_id == $column->id)
                                <div class="row">
                                    <div class="col card">
                                        {{ $card->title }}
                                            @if ($card->order_number > 1)
                                                <form action="{{ route('cards.update', $card->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="moveUp">
                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-arrow-up"></i></button>
                                                </form>
                                            @endif
                                            <!-- Implement when ready 
                                                <form action="{{ route('cards.update', $card->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="action" value="moveDown">
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-arrow-down"></i></button>
                                            </form> -->
                                        <form action="{{ route('cards.destroy', $card->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">X</button>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    <div class="col-3 column">
                        <div class="row">
                            <div class="col">
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add column</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
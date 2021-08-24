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
                                    <form action="{{ route('columns.destroy', $column->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-3 column">
                        <div class="row">
                            <div class="col">
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Add column</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{url('matched')}}" name ="matchingForm" method="post">
                @csrf
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary mb-2"  value="Match" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                    <select class="form-control  multiple" multiple ="multiple" name="userMatch" id="idUserMatched" >
                        @if($dataMatched!= null)
                            @foreach($dataMatched as $d)
                                <option value="{{$d}}">{{$d}}</option>
                            @endforeach
                        @endif
                    </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection




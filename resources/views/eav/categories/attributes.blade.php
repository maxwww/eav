@foreach($attributes as $key => $attribute)
    @if($attribute->type == 'text')
        <div class="form-group">
            <div class="col-xs-12">
                <label for="params[{{ $attribute->slug }}]">{{ $attribute->name }}:</label>
                <input type="text" name="params[{{ $attribute->id }}]" class="form-control input-lg">
            </div>
        </div>
    @elseif($attribute->type == 'checkbox')
        <div class="form-group">
            <div class="col-xs-12">
                <label>{{ $attribute->name }}:</label>
                @foreach(json_decode($attribute->options, true) as $key => $option)
                    <div class="col-xs-12">
                        <input type="checkbox" name="params[{{ $attribute->id }}][]" value="{{ $key }}"> {{ $option }}
                    </div>
                @endforeach
            </div>
        </div>
    @elseif($attribute->type == 'radio')
        <div class="form-group">
            <div class="col-xs-12">
                <label>{{ $attribute->name }}:</label>
                @foreach(json_decode($attribute->options, true) as $key => $option)
                    <div class="col-xs-12">
                        <input type="radio" name="params[{{ $attribute->id }}]" value="{{ $key }}"> {{ $option }}
                    </div>
                @endforeach
            </div>
        </div>
    @elseif($attribute->type == 'select')
        <div class="form-group">
            <div class="col-xs-12">
                <label>{{ $attribute->name }}:</label>
                <select name="params[{{ $attribute->id }}]" class="form-control input-lg" required="">
                    @foreach(json_decode($attribute->options, true) as $key => $option)
                        <option value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @elseif($attribute->type == 'textarea')
        <div class="form-group">
            <div class="col-xs-12">
                <label>{{ $attribute->name }}:</label>
                <textarea class="form-control input-lg" name="params[{{ $attribute->id }}]"
                          rows="5">Some text...</textarea>
            </div>
        </div>
    @endif
@endforeach
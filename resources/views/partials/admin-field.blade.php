<label>{{ $label ?? ucwords(str_replace('_',' ',$field)) }}
@if(($kind??'text')==='textarea')<textarea name="{{ $field }}" rows="{{ $rows??5 }}">{{ old($field,$value??'') }}</textarea>
@else<input type="{{ $kind??'text' }}" name="{{ $field }}" value="{{ old($field,$value??'') }}" @if($required??false) required @endif @if(($kind??'')==='number') min="0" @endif>
@endif</label>

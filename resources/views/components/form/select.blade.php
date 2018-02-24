<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    {{ Form::select($name, $data, $selected, array_merge(['class' => 'form-control select2'], $attributes)) }}
</div>
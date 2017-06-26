<li @if($task->done == 1) class="complete" @endif >
    @if(!isset($is_editable) || !$is_editable)
        <input type="checkbox" name="tasks[]" value="{{ $task->id }}">
        {{ $task->task }}
    @else
        <input type="hidden" name="tasks[{{ $task->id }}][id]" value="{{ $task->id }}">
        <input type="text" class="form-control" name="tasks[{{ $task->id }}][task]" value="{{ $task->task }}">
    @endif
</li>
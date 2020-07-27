<form action="{{ $route }}" method="POST">
    @csrf
    @if (isset($group))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="inputGroupName">Название группы</label>
        <input type="text" class="form-control" name="name" id="inputGroupName" value="{{ $group->name ?? '' }}" placeholder="Введите название группы">
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($group) ? 'Отредактировать группу' : 'Создать новую группу' }}</button>
</form>

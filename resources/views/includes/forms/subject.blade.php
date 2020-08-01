<form action="{{ $route }}" method="POST">
    @csrf
    @if (isset($subject))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="inputSubjectName">Название предмета</label>
        <input type="text" class="form-control" name="name" id="inputSubjectName" value="{{ $subject->name ?? '' }}" placeholder="Введите название предмета">
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($subject) ? 'Отредактировать предмет' : 'Создать новый предмет' }}</button>
</form>

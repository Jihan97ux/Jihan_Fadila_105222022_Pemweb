<table class="table table-schedule">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->start }}</td>
                <td>{{ $event->end }}</td>
                <td>
                    <button class="btn btn-primary edit-btn" data-id="{{ $event->id }}" data-toggle="modal" data-target="#editModal">E</button>
                    <form action="{{ route('event.delete') }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-danger">D</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" action="{{ route('event.update') }}">
            @csrf
            <input type="hidden" name="id" id="editId">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama Event</label>
                    <input type="text" id="editTitle" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="start">Tanggal Mulai</label>
                    <input type="date" id="editDate" name="start" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end">Tanggal Selesai</label>
                    <input type="date" id="editDescription" name="end" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>


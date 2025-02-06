<div class="container">
    <h2>Clients</h2>
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Add New Client</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Registered Address</th>
                <th>Authorized Personnel</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->client_id }}</td>
                <td>{{ $client->registered_company_name }}</td>
                <td>{{ $client->registered_address }}</td>
                <td>{{ $client->authorized_personnel }}</td>
                <td>
                    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('clients.archive', $client->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Archive</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
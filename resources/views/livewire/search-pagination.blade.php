<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{--                <input type="text" class="form-control dropdown-toggle" placeholder="Search" wire:model="searchTerm"/>--}}
            <div class="app-search dropdown d-none d-lg-block">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control dropdown-toggle" wire:model="searchTerm"
                               placeholder="Search..." id="top-search">
                        <span class="mdi mdi-magnify search-icon"></span>
                    </div>
                </form>
                <br>
                <table class="table table-centered mb-0">
                    <thead class="table-dark">
                    <tr>
                        <th>{{ __('sentence.Name_Client') }}</th>
                        <th>{{ __('sentence.Vat_Client') }}</th>
                        <th>{{ __('sentence.Address_Client') }}</th>
                        <th>{{ __('sentence.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @forelse($employees as $client)
                        <tr>
                            <td>{{ $client->company }}</td>
                            <td>{{ $client->vat }}</td>
                            <td>{{ $client->address }}</td>
                            <td>
                                @if($user->id == '1')
                                    @can('client-edit')
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-info">
                                            {{ __('sentence.Edit') }}
                                        </a>
                                    @endcan
                                    @can('client-delete')
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                              onsubmit="return confirm('{{ __('sentence.Addـnewـuser') }}');"
                                              style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="{{ __('sentence.Delete') }}">
                                        </form>
                                    @endcan
                                @else
                                    No actions for this account
                                @endif
                            </td>
                        </tr>
                    @empty
                        <h4 class="header-title">No users</h4>
                    @endforelse
                    </tbody>
                </table>
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>

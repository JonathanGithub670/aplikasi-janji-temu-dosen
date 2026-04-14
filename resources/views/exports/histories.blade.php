<table>
    <thead>
        <tr>
            <th>No</th>
            @can('isAdmin')
                <th>Pengirim</th>
            @endcan
            <th>Penerima</th>
            <th>Waktu</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($histories as $key => $history)
            <tr>
                <td>{{ $loop->iteration }}</td>
                @can('isAdmin')
                    <td>{{ $history->create->name }}</td>
                @elsecan('isDosen')
                    <td>{{ $history->create->name }}</td>
                @endcan
                <td>{{ $history->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($history->datetime)->translatedFormat('l, d F Y H:i') }}</td>
                <td>
                    {{-- @dd($item->status) --}}
                    @if ($history->status === 1)
                        Diterima
                    @elseif($history->status === 0)
                        Ditolak
                    @elseif ($history->status == null)
                        Proses
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Belum Ada Reservasi Terkirim</td>
            </tr>
        @endforelse
    </tbody>
</table>

<table class="datatable-init nowrap table">
    <thead>
    <tr>
        <th>Date</th>
        <th>Arrival/Departure</th>
        <th>Address</th>
        <th>Amount</th>
        @admin
        <th>Booked By</th>
        <th>Hosted By</th>
        @endadmin
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($bookings as $key => $booking)
        <tr>
            <td>{{ \Carbon\Carbon::parse($booking->date)->format('dS M Y') }} </td>
            <td>
                {{ \Carbon\Carbon::parse($booking->arrival_time)->format('h:i A') }} 
                - 
                {{ \Carbon\Carbon::parse($booking->departure_time)->format('h:i A') }}
            </td>
            <td title="{{ $booking->space->address }}">{{ htmlToText($booking->space->address, 30) }}</td>
            <td>${{$booking->amount}}</td>
            @admin
            <td>{{$booking->customer->fname }} {{$booking->customer->lname }} </td>
            <td>{{$booking->host->fname }} {{$booking->host->lname }} </td>
            @endadmin
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a id="view" title="View Space Detail" class="btn btn-info btn-sm" href="{{ route('front.space-detail', ['id' => encrypt($booking->space->id)]) }}">
                    <em class="icon ni ni-eye"></em></a>
                </div>                                               
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
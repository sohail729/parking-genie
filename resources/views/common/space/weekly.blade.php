<table class="datatable-init nowrap table">
    <thead>
    <tr>
        <th>From</th>
        <th>To</th>
        <th>No of weeks</th>
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
            <td>{{$booking->from_date}}</td>
            <td>{{$booking->to_date}}</td>
            <td>{{$booking->weeks}}</td>

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